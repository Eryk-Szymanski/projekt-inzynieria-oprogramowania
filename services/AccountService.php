<?php declare(strict_types=1);

    include '../db/AccountRepository.php';

    class AccountService {

        private AccountRepository $repository;

        public function __construct() {
            $this->repository = new AccountRepository();
        }

        public function login(string $email, string $pass) {

            $error = "";
            if (empty($email))
                echo "<script>history.back();</script>";

            $result = $this->repository->getUserForLogin($email);
            if(isset($result['user'])) {
                $user = $result['user'];
                if ($user && password_verify($pass, $user['pass'])) 
                    return [
                        "success" => "Prawidłowo zalogowano użytkownika $email",
                        "user_role" => $user['role'],
                        "user_name" => $user['name'],
                        "user_id" => $user['id']
                    ];

            }

            return ["error" => $result['error']];
        }

        public function register($user) {

            $error = 0;
            foreach ($user as $key => $value) {
                if (empty($value))
                    $error = 1;
            }

            if (!isset($user['agreeTerms']))
                $error = 1;

            if($error == 1)
                echo "<script>history.back();</script>";

            $user['hash'] = password_hash($user['pass1'], PASSWORD_ARGON2ID); 
            
            $result = $this->repository->createUser($user);
            if(isset($result['success']))
                return ["success" => "Prawidłowo zarejestrowano użytkownika"];

            return ["error" => $result['error']];
        }

        public function logout() {

            $error = "";
            try {
                $_SESSION = array();

                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }

                session_destroy();
                return ["success" => "Poprawnie wylogowano"];

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie wylogowano";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getUser(int $user_id) {

            if (empty($user_id))
                echo "<script>history.back();</script>";

            $result = $this->repository->getUser($user_id);
            if(isset($result['success']))
                return $result['user'];

            return null;
        }

        public function getAddress(int $address_id) {

            if (empty($address_id))
                echo "<script>history.back();</script>";

            $result = $this->repository->getAddress($address_id);
            if(isset($result['success'])) 
                return $result['address'];
            
            return null;
        }

        public function getUsers() {

            $result = $this->repository->getUsers();
            if(isset($result['success'])) 
                return $result['users'];
            
            return null;
        }
    }

?>