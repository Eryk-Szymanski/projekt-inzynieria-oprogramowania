<?php declare(strict_types=1);

    include '../services/AccountService.php';

    class AccountController {

        private AccountService $service;
        private static AccountController $instance;

        private function __construct() {
            
            $this->service = new AccountService();
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new AccountController();
            }
            return self::$instance;
        }

        public function login(string $email) {
            $result = $this->service->login($email);
            if($result)
                return header('location: ../views/logged.php');
            return header('location: ../');
        }

        public function logout() {
            $this->service->logout();
            return header('location: ../');
        }
        
        public function register($data) {
            $this->service->register($data);
            return header('location: ../');
        }

        public function getUser(int $user_id) {
            return $this->service->getUser($user_id);  
        }

        public function getUsers() {
            return $this->service->getUsers();
        }

        public function getAddress(int $address_id) {
            return $this->service->getAddress($address_id);  
        }

    }

?>