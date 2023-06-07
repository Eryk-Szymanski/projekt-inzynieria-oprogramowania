<?php

    require_once '../services/OrderService.php';

    class OrderController {

        public static function changeOrderStatus($data) {
            acceptRejectOrder($data);  
        }

        public static function newOrder($data) {
            registerOrder($data);     
        }

        public static function getDeliveryMethods() {
            return getDeliveryMethodsData();
        }

        public static function getPaymentMethods() {
            return getPaymentMethodsData();
        }

        public static function getOrder($order_number) {
            return getOneOrder($order_number); 
        }

        public static function getOrdersByStatus($status) {
            return getOrdersDataByStatus($status);    
        }

        public static function getUserOrders($user_id) {
            return getUserOrdersData($user_id);   
        }

    }

?>