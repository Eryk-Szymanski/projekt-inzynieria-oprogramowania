<?php

    namespace model;

    use model\interfaces\IDbObject;
    require_once './interfaces/IDbObject.php';

    class Order implements IDbObject {
        public $id;
        public $number;
        public $status_id;
        public $user_id;
        public $products;
        public $payment_method_id;
        public $delivery_method_id;
        public $delivery_delivery_address_id;
        public $total_price;
        public $comments;
        public $created_at;

        public function __construct(
            $id = null, 
            $number = null, 
            $status_id = null, 
            $user_id = null, 
            $products = null,
            $payment_method_id = null,
            $delivery_method_id = null,
            $delivery_address_id = null,
            $total_price = null,
            $comments = null,
            $created_at = null
        ) 
        {
            $this->id = $id;
            $this->number = $number;
            $this->status_id = $status_id;
            $this->user_id = $user_id;
            $this->products = $products;
            $this->payment_method_id = $payment_method_id;
            $this->delivery_method_id = $delivery_method_id;
            $this->delivery_address_id = $delivery_address_id;
            $this->total_price = $total_price;
            $this->comments = $comments;
            $this->created_at = $created_at;
        }

        public function changeStatus($status) {
            $this->status = $status;
        }
    }

?>