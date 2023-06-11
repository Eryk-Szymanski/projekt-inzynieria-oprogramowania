<?php declare(strict_types=1);

    include '../db/OrderRepository.php';

    class OrderService {

        private OrderRepository $repository;

        public function __construct() {
            $this->repository = new OrderRepository();
        }

        public function newOrder($order) {

            $error = 0;
            foreach ($order as $key => $value) {
                if (empty($value)) 
                    $error = 1;
            }

            if (!isset($order['agreeTerms'])) 
                $error = 1;

            session_start();

            if(!isset($_SESSION['cart'])) 
                $error = 1;

            if($error == 1) 
                echo "<script>history.back();</script>";
            
            $order['number'] = strval(date("YmdHms"));
            $products = array();
            foreach($_SESSION['cart'] as $key => $value) {
                $product = array('product_id' => $key, 'quantity' => $value);
                array_push($products, $product);
            }
            $order['products'] = json_encode($products);
            $order['cart_value'] = $_SESSION['cart_value'];

            $result = $this->repository->createOrder($order);
            if(isset($result['error'])) {
                echo $result['error'];
                $_SESSION['error'] = $result['error'];
            } else {
                unset($_SESSION['cart']);
                unset($_SESSION['cart_value']);
                $_SESSION['success'] = "Prawidłowo utworzono zamówienie";
                return true;
            }

            return false;
        }

        public function changeOrderStatus($data) {
            
            $error = 0;
            foreach ($data as $key => $value) {
                if (empty($value))
                    $error = 1;
            }

            if(!isset($data['number']))
                $error = 1;

            if($error == 1) 
                echo "<script>history.back();</script>";

            session_start();

            if(isset($data['decision'])) {
                $decision = 0;
                switch($_POST['decision']) {
                    case 'accept':
                        $decision = 2;
                        break;
                    case 'reject':
                        $decision = 3;
                        break;
                }
                $result = $this->repository->changeOrderStatus($data['number'], $decision);
                if(isset($result['error'])) {
                    $_SESSION['error'] = $result['error'];
                } else {
                    $_SESSION['success'] = "Prawidłowo zmieniono status zamówienia";
                    return true;
                }
            }

            return false;
        }

        public function getOrder(string $orderNumber) {

            $result = $this->repository->getOrder($orderNumber);
            if(isset($result['success'])) 
                return $result['order'];
            
            return null;
        }

        public function getPaymentMethods() {

            $result = $this->repository->getPaymentMethods();
            if(isset($result['success'])) 
                return $result['payment_methods'];
            
            return null;
        }

        public function getDeliveryMethods() {

            $result = $this->repository->getDeliveryMethods();
            if(isset($result['success'])) 
                return $result['delivery_methods'];
            
            return null;
        }

        public function getUserOrders(int $user_id) {

            $result = $this->repository->getUserOrders($user_id);
            if(isset($result['success'])) 
                return $result['orders'];
            
            return null;
        }

        public function getOrdersByStatus(int $status_id) {

            $result = $this->repository->getOrdersByStatus($status_id);
            if(isset($result['success'])) 
                return $result['orders'];

            return null;
        }

    }

?>