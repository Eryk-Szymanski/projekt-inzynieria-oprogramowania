<?php

    require_once '../services/AccountService.php';

    class AccountController {

        public static function login($email) {
            loginUser($email);
        }

        public static function logout() {
            logoutUser();
        }
        
        public static function register($data) {
            registerUser($data);
        }

        public static function getUser($user_id) {
            return getUserData($user_id);  
        }

        public static function getUsers() {
            return getAllUsers();
        }

        public static function getAddress($address_id) {
            return getAddressData($address_id);  
        }

    }

?>