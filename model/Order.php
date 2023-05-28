<?php

    class Order {
        public $id;
        public $number;
        public $status;
        public $user_id;
        public $products;
        public $quantities;
        public $paymentMethod;
        public $deliveryMethod;
        public $deliveryAddress;
        public $totalPrice;
        public $comments;

        public function changeStatus($status) {
            $this->status = $status;
        }
    }

?>