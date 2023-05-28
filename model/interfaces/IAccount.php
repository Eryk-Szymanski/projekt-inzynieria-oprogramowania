<?php

    /**
     * @property int $id
     * @property string $name
     * @property string $surname
     * @property string $email
     * @property string $phone
     * @property string $password
     * @property string $role
     * @property Address $address
     */
    interface IAccount {
        public function getFullName();
    }

?>