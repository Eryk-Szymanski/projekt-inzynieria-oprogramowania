<?php

    namespace model;

    use model\interfaces\IDbObject;
    require_once './interfaces/IDbObject.php';

    class Product implements IDbObject {
        public $id;
        public $name;
        public $weight;
        public $is_available;
        public $description;
        public $calories;
        public $price;
        public $image_path;

        public function __construct(
            $id = null, 
            $name = null, 
            $weight = null, 
            $is_available = null, 
            $description = null,
            $calories = null,
            $price = null,
            $image_path = null
        ) 
        {
            $this->id = $id;
            $this->name = $name;
            $this->weight = $weight;
            $this->is_available = $is_available;
            $this->description = $description;
            $this->calories = $calories;
            $this->price = $price;
            $this->image_path = $image_path;
        }
    }

?>