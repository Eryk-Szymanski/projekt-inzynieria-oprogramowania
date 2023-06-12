<?php

    namespace model\interfaces;

    /**
     * @property IController $instance
     * @property IService $service
     */
    interface IController {
        public static function getInstance();
    }

?>