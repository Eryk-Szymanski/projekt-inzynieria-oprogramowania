<?php
    require_once '../services/ProductService.php';

    $product = getProductDetails($_GET['product_id']);
?>