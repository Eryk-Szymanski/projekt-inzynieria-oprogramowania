<?php

    session_start();

    $error = 0;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if (!isset($_POST['agreeTerms'])) {
        $error = 1;
    }

    if(!isset($_SESSION['cart'])) {
        $error = 1;
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    require_once 'connect.php';
    
    try {
        $orderNumber = strval(date("YmdHms"));
        $products = array();
        foreach($_SESSION['cart'] as $key => $value) {
            $product = array('product_id' => $key, 'quantity' => $value);
            array_push($products, $product);
        }
        $productsJSON = json_encode($products);

        $stmt = $mysqli->prepare("INSERT INTO `orders` (`number`, `user_id`, `products`, `payment_method_id`, `delivery_method_id`, `delivery_address_id`, `total_price`, `comments`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sisiiids", $orderNumber, $_POST['user_id'], $productsJSON, $_POST['paymentMethod'], $_POST['deliveryMethod'], $_POST['address_id'], $_SESSION['cart_value'], $_POST['comments']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            $_SESSION['success'] = "Prawidłowo utworzono zamówienie nr $orderNumber";
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        if($stmt->affected_rows != 1) {
            $_SESSION['error'] = "Nie utworzono zamówienia";
        }
    } finally {
        unset($_SESSION['cart']);
        unset($_SESSION['cart_value']);
    }

    header('location: ../views/logged.php');
?>