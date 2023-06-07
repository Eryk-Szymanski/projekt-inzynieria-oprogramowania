<?php

    require_once('./AccountController.php');
    require_once('./OrderController.php');
    require_once('./ProductController.php');

    if (isset($_POST['login'])){
        unset($_POST['login']);
        AccountController::login($_POST['email']);
    }

    if (isset($_POST['logout'])){
        unset($_POST['logout']);
        AccountController::logout();
    }

    if (isset($_POST['register'])){
        unset($_POST['register']);
        AccountController::register($_POST);
    }

    if (isset($_POST['acceptOrder'])){
        unset($_POST['acceptOrder']);
        OrderController::changeOrderStatus($_POST);
    }

    if (isset($_POST['rejectOrder'])){
        unset($_POST['rejectOrder']);
        OrderController::changeOrderStatus($_POST);
    }

    if (isset($_POST['newOrder'])){
        unset($_POST['newOrder']);
        OrderController::newOrder($_POST);
    }

    if (isset($_POST['addProduct'])){
        unset($_POST['addProduct']);
        require_once('./uploadFile.php');
        $_POST['image_path'] = $target_file;
        ProductController::newProduct($_POST);
    }

    if (isset($_POST['editProduct'])){
        unset($_POST['editProduct']);
        require_once('./uploadFile.php');
        $_POST['image_path'] = $target_file;
        ProductController::editProduct($_POST);
    }

    if (isset($_POST['deleteProduct'])){
        unset($_POST['deleteProduct']);
        ProductController::deleteProduct($_POST['product_id']);
    }

    if (isset($_POST['addToCart'])){
        unset($_POST['addToCart']);
        ProductController::addProductToCart($_POST);
    }

?>