<?php
    require_once '../services/OrderService.php';

    $order = getOneOrder($_GET['number']);    
?>