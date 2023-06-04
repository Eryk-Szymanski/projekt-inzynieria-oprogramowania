<?php declare(strict_types=1);

function getUserForLogin(string $email) {
    require_once 'connect.php';

    $error = 0;
    try {
        $stmt = $mysqli->prepare("SELECT users.id, users.name, users.pass, roles.role FROM `users` JOIN `roles` ON users.role_id = roles.id WHERE `email` = ?");
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

function createUser($user) {
    require_once 'connect.php';

    $error = 0;
    try {
        $stmt = $mysqli->prepare("INSERT INTO `addresses` (`zipcode`, `city`, `street`, `apartment`) VALUES (?, ?, ?, ?);");
        $stmt->bind_param('ssss', $user['zipcode'], $user['city'], $user['street'], $user['apartment']);
        $stmt->execute();

        $address_id = $mysqli->insert_id;
        
        $stmt = $mysqli->prepare("INSERT INTO `users` (`name`, `surname`, `email`, `phone`, `pass`, `address_id`) VALUES (?, ?, ?, ?, ?, ?);");
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

?>