<?php

    namespace model\interfaces;

    use model\interfaces\IDbActions;
    require_once '../model/interfaces/IDbActions.php';

    /**
     * @property IRepository $repository
     */
    interface IService extends IDbActions {}

?>