<?php

    namespace model;

    use model\interfaces\IDbObject;
    require_once 'interfaces/IDbObject.php';

    class Address implements IDbObject {
        public $id;
        public $zipcode;
        public $city;
        public $street;
        public $apartment;

        public function __construct($id = null , $zipcode = null, $city = null, $street = null, $apartment = null) {
            $this->id = $id;
            $this->zipcode = $zipcode;
            $this->city = $city;
            $this->street = $street;
            $this->apartment = $apartment;
        }
    }

?>