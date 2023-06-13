<?php

    namespace model\interfaces;

    /**
     * @property mysqli $connection
     */
    interface IRepository {
        public function createNew($data);
        public function getAll();
        public function getById($id);
    }

?>