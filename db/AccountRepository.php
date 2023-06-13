<?php declare(strict_types=1);

    use model\interfaces\IRepository;
    require_once '../model/interfaces/IRepository.php';

    class AccountRepository implements IRepository {

        private mysqli $connection;

        public function __construct() {
            include '../scripts/connect.php';
            $this->connection = $mysqli;
        }

        public function getUserForLogin(string $email) {

            $error = "";
            try {
                $stmt = $this->connection->prepare("SELECT users.id, users.name, users.pass, roles.role FROM `users` JOIN `roles` ON users.role_id = roles.id WHERE `email` = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if ($stmt->affected_rows == 1) {
                    return [ "success" => true, "user" => $user];
                }

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie znaleziono użytkownika $email";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error, "user" => null];
        }

        public function createNew($user) {

            $error = "";
            try {
                $stmt = $this->connection->prepare("INSERT INTO `addresses` (`zipcode`, `city`, `street`, `apartment`) VALUES (?, ?, ?, ?);");
                $stmt->bind_param('ssss', $user['zipcode'], $user['city'], $user['street'], $user['apartment']);
                $stmt->execute();

                $address_id = $this->connection->insert_id;
                
                $stmt = $this->connection->prepare("INSERT INTO `users` (`name`, `surname`, `email`, `phone`, `pass`, `address_id`) VALUES (?, ?, ?, ?, ?, ?);");
                $stmt->bind_param("sssssi", $user['name'], $user['surname'], $user['email1'], $user['phone'], $user['hash'], $address_id);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    return ["success" => true];
                }

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie utworzono użytkownika $email";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getById($user_id) {

            $error = "";
            try {
                $sql = "SELECT id, name, surname, email, phone, address_id FROM `users` WHERE id = $user_id";
                $result = $this->connection->query($sql);
                $user = $result->fetch_assoc();

                if ($user) {
                    return [ "success" => true, "user" => $user];
                }

            }
            catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie utworzono użytkownika $email";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getAddress($address_id) {

            $error = "";
            try {
                $sql = "SELECT * FROM `addresses` WHERE id = $address_id";
                $result = $this->connection->query($sql);
                $address = $result->fetch_assoc();

                if ($address) {
                    return [ "success" => true, "address" => $address];
                }

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie utworzono użytkownika $email";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getAll() {

            $error = "";
            try {
                $sql = "SELECT users.id, users.name, users.surname, roles.role FROM `users` JOIN `roles` ON users.role_id = roles.id";
                $result = $this->connection->query($sql);
                $rows = [];
                while($row = $result->fetch_assoc()) {
                    array_push($rows, $row);
                }
            
                if ($rows) {
                    return ["success" => true, "users" => $rows];
                }
                
            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie pobrano użytkowników";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

    }

?>