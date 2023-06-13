<?php

    namespace model\interfaces;

    interface IDbActions {

        public function createNew($data);

        public function getAll();

        public function getById($id);
        
    }

?>