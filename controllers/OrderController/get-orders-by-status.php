<?php
    require_once '../services/OrderService.php';

    $orders0 = getOrdersDataByStatus(0);    
    $orders1 = getOrdersDataByStatus(1);    
    $orders2 = getOrdersDataByStatus(2);    
?>