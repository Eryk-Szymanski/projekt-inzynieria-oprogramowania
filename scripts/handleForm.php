<?php

    include('../controllers/AccountController.php');
    include('../controllers/OrderController.php');
    include('../controllers/ProductController.php');

    if (isset($_POST['login'])){
        unset($_POST['login']);
        session_start();
        $result = AccountController::getInstance()->login($_POST['email'], $_POST['pass']);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            $_SESSION['user_role'] = $result['user_role'];
            $_SESSION['user_name'] = $result['user_name'];
            $_SESSION['user_id'] = $result['user_id'];
            header('location: ../views/logged.php');
        } else {
            $_SESSION['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['logout'])){
        unset($_POST['logout']);
        session_start();
        $result = AccountController::getInstance()->logout();
        if(isset($result['success']))
            $_SESSION['success'] = $result['success'];
        else
            $_SESSION['error'] = $result['error'];
        header('location: ../');
        exit();
    }

    if (isset($_POST['register'])){
        unset($_POST['register']);
        session_start();
        $result = AccountController::getInstance()->register($_POST);
        if(isset($result['success']))
            $_SESSION['success'] = $result['success'];
        else
            $_SESSION['error'] = $result['error'];
        header('location: ../');
        exit();
    }

    if (isset($_POST['acceptOrder'])){
        unset($_POST['acceptOrder']);
        session_start();
        $result = OrderController::getInstance()->changeOrderStatus($_POST);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            header('location: ../views/logged.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['rejectOrder'])){
        unset($_POST['rejectOrder']);
        session_start();
        $result = OrderController::getInstance()->changeOrderStatus($_POST);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            header('location: ../views/logged.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['newOrder'])){
        unset($_POST['newOrder']);
        session_start();
        $result = OrderController::getInstance()->newOrder($_POST, $_SESSION['cart'], $_SESSION['cart_value']);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            unset($_SESSION['cart']);
            unset($_SESSION['cart_value']);
            header('location: ../views/logged.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['addProduct'])){
        unset($_POST['addProduct']);
        session_start();
        require_once('./uploadFile.php');
        $_POST['image_path'] = uploadFile($_FILES, "");
        $result = ProductController::getInstance()->newProduct($_POST);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            header('location: ../views/products.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['editProduct'])){
        unset($_POST['editProduct']);
        session_start();
        require_once('./uploadFile.php');
        $_POST['image_path'] = uploadFile($_FILES, $_POST['image_path']);
        $result = ProductController::getInstance()->updateProduct($_POST);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            header('location: ../views/products.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['deleteProduct'])){
        unset($_POST['deleteProduct']);
        session_start();
        $result = ProductController::getInstance()->deleteProduct($_POST['product_id']);
        if(isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
            header('location: ../views/products.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

    if (isset($_POST['addToCart'])){
        unset($_POST['addToCart']);
        session_start();
        if(!isset($_SESSION['cart']))
            $_SESSION['cart'] = [];
        $result = ProductController::getInstance()->addProductToCart($_POST, $_SESSION['cart']);
        if(isset($result['success'])) {
            $_SESSION['cart'] = $result['cart'];
            $_SESSION['success'] = $result['success'];
            header('location: ../views/products.php');
        } else {
            $_SESSION['error'] = $result['error'];
            header('location: ../');
        }
        exit();
    }

?>