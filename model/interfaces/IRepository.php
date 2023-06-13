<?php

    namespace model\interfaces;

    use model\interfaces\IDbActions;
    require_once '../model/interfaces/IDbActions.php';

    /**
     * @property mysqli $connection
     */
    interface IRepository extends IDbActions {
        public function createNew($data);
        public function getAll();
        public function getById($id);
    }

?>