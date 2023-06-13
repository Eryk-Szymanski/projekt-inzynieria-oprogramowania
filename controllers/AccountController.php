<?php declare(strict_types=1);

    use model\interfaces\IController;
    require_once '../model/interfaces/IController.php';

    include '../services/AccountService.php';

    class AccountController implements IController {

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
        
        public function createNew($data) {
            return $this->service->createNew($data);
        }

        public function getById(int $user_id) {
            return $this->service->getById($user_id);  
        }

        public function getAll() {
            return $this->service->getAll();
        }

        public function getAddress(int $address_id) {
            return $this->service->getAddress($address_id);  
        }

    }

?>