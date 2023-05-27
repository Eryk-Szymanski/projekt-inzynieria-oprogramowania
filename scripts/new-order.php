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

        $stmt = $mysqli->prepare("INSERT INTO orders(number, user_id, products, final_price, comment, name, surname, zipcode, city_id, street, building) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisdssssiss", $orderNumber, $_SESSION['user_id'], $productsJSON, $_SESSION['cart_value'], $_POST['comment'], $_POST['name'], $_POST['surname'], $_POST['zipcode'], $_POST['city_id'], $_POST['street'], $_POST['building']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            echo "działa";
            $_SESSION['success'] = "Prawidłowo utworzono zamówienie nr $testNumber";
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