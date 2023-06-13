<?php

    namespace model\interfaces;

    use model\interfaces\IDbActions;
    require_once '../model/interfaces/IDbActions.php';

    /**
     * @property IController $instance
     * @property IService $service
     */
    interface IController extends IDbActions {
        public static function getInstance();
    }

?>