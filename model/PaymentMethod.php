<?php

    namespace model;

    use model\interfaces\IDbObject;
    require_once './interfaces/IDbObject.php';

    class PaymentMethod implements IDbObject {
        public $id;
        public $name;

        public function __construct($id = null , $name = null) {
            $this->id = $id;
            $this->name = $name;
        }
    }

?>