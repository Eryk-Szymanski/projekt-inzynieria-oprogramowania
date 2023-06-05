<?php
    require_once '../services/OrderService.php';

    $orders = getUserOrdersData($_SESSION['user_id']);    
?>