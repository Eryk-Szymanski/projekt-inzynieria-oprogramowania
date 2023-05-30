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
        $is_available = 0;
        if(isset($_POST['is_available']))
            $is_available = 1;
        $stmt = $mysqli->prepare("INSERT INTO products(name, weight, is_available, description, calories, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siisii", $_POST['name'], $_POST['weight'], $is_available, $_POST['description'], $_POST['calories'], $_POST['price']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            $_SESSION['success'] = "Prawidłowo utworzono produkt";
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        if($stmt->affected_rows != 1) {
            $_SESSION['error'] = "Nie utworzono produktu";
        }
    }

    header('location: ../views/products.php');
?>