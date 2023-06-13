<?php

    namespace model;

    use model\interfaces\IDbObject;
    require_once './interfaces/IDbObject.php';

    class DeliveryMethod implements IDbObject {
        public $id;
        public $name;
        public $price;
        public $delivery_time;

        public function __construct($id = null , $name = null, $price = null, $delivery_time = null) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->delivery_time = $delivery_time;
        }
    }

?>