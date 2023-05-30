<?php

    session_start();

    $error = 0;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    require_once 'connect.php';
    
    try {
        $_SESSION['cart'][$_POST['product_id']] = $_POST['quantity'];

    } catch (Exception $e) {
        echo $e->getMessage();
        $_SESSION['error'] = "Nie dodano produktu";
    }

    header('location: ../views/products.php');
?>