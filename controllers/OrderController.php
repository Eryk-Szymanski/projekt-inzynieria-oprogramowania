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

        public function newOrder($data, $cart, $cart_value) {
            return $this->service->newOrder($data, $cart, $cart_value);    
        }

        public function getDeliveryMethods() {
            return $this->service->getDeliveryMethods();
        }

        public function getPaymentMethods() {
            return $this->service->getPaymentMethods();
        }

        public function getOrder(string $order_number) {
            return $this->service->getOrder($order_number); 
        }

        public function getOrdersByStatus(int $status_id) {
            return $this->service->getOrdersByStatus($status_id);    
        }

        public function getUserOrders(int $user_id) {
            return $this->service->getUserOrders($user_id);   
        }

    }

?>