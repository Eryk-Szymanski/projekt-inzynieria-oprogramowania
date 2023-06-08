<?php

    include '../services/AccountService.php';

    class AccountController {

        private $service;
        private static $instance;

        private function __construct() {
            $this->service = new AccountService();
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new AccountController();
            }
            return self::$instance;
        }

        public function login($email) {
            $this->service->loginUser($email);
        }

        public function logout() {
            $this->service->logoutUser();
        }
        
        public static function register($data) {
            registerUser($data);
        }

        public static function getUser($user_id) {
            return getUserData($user_id);  
        }

        public function getUsers() {
            return $this->service->getAllUsers();
        }

        public static function getAddress($address_id) {
            return getAddressData($address_id);  
        }

    }

?>