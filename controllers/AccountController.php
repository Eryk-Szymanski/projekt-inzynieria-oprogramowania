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

        public function login(string $email, string $pass) {
            return $this->service->login($email, $pass);
        }

        public function logout() {
            return $this->service->logout();
        }
        
        public function register($data) {
            return $this->service->register($data);
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