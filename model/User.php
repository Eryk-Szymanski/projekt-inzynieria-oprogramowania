<?php

    namespace model;

    use model\interfaces\IDbObject;
    require_once './interfaces/IDbObject.php';

    class User implements IDbObject {
        public $id;
        public $name;
        public $surname;
        public $email;
        public $phone;
        public $pass;
        public $role_id;
        public $address_id;
        public $created_at;

        public function __construct(
            $id = null, 
            $name = null, 
            $surname = null, 
            $email = null, 
            $phone = null,
            $pass = null,
            $role_id = null,
            $address_id = null,
            $created_at = null
        ) 
        {
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->phone = $phone;
            $this->pass = $pass;
            $this->role_id = $role_id;
            $this->address_id = $address_id;
            $this->created_at = $created_at;
        }
    }

?>