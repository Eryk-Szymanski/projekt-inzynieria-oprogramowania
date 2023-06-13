<?php declare(strict_types=1);

    use model\interfaces\IController;
    require_once '../model/interfaces/IController.php';

    include '../services/OrderService.php';

    class OrderController implements IController {

        private OrderService $service;
        private static OrderController $instance;

        private function __construct() {
            $this->service = new OrderService();
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new OrderController();
            }
            return self::$instance;
        }

        public function changeOrderStatus($data) {
            return $this->service->changeOrderStatus($data);  
        }

        public function createNew($data) {
            return $this->service->createNew($data);    
        }

        public function getDeliveryMethods() {
            return $this->service->getDeliveryMethods();
        }

        public function getPaymentMethods() {
            return $this->service->getPaymentMethods();
        }

        public function getById($order_number) {
            return $this->service->getById($order_number); 
        }

        public function getAll() {
            return $this->service->getAll(); 
        }

        public function getOrdersByStatus(int $status_id) {
            return $this->service->getOrdersByStatus($status_id);    
        }

        public function getUserOrders(int $user_id) {
            return $this->service->getUserOrders($user_id);   
        }

    }

?>