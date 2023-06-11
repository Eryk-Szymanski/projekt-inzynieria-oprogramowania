<?php declare(strict_types=1);

    include '../db/AccountRepository.php';

    class AccountService {

        private AccountRepository $repository;

        public function __construct() {
            $this->repository = new AccountRepository();
        }

        public function login(string $email) {
            session_start();

            if (empty($email))
                echo "<script>history.back();</script>";

            $result = $this->repository->getUserForLogin($email);
            if(isset($result['user'])) {
                $user = $result['user'];
            } else {
                $_SESSION['error'] = $result['error'];
            }

            if ($user && password_verify($_POST['pass'], $user['pass'])) {
                $_SESSION['success'] = "Prawidłowo zalogowano użytkownika $_POST[email]";
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_id'] = $user['id'];
                return true;
            } else {
                $_SESSION['error'] = "Nie zalogowano użytkownika $_POST[email]";
            }
            return false;
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
            
            session_start();

            $result = $this->repository->createUser($user);
            if(isset($result['error']))
                $_SESSION['error'] = $result['error'];
            else
                $_SESSION['success'] = "Prawidłowo zarejestrowano użytkownika";

        }

        public function logout() {
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();
        }

        public function getUser(int $user_id) {

            if (empty($user_id))
                echo "<script>history.back();</script>";

            $result = $this->repository->getUser($user_id);
            if(isset($result['success'])) {
                return $result['user'];
            }
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