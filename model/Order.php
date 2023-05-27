<?php

    class Order {
        public $id;
        public $orderNumber;
        public $status;
        public $products;
        public $quantities;
        public $paymentMethod;
        public $deliveryMethod;
        public $deliveryAddress;
        public $totalPrice;
        public $comments;
        public $client_id;

        public function changeStatus($status) {
            $this->status = $status;
        }
    }

?>