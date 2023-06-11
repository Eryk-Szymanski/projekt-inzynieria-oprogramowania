<?php

    include('../controllers/AccountController.php');
    include('../controllers/OrderController.php');
    include('../controllers/ProductController.php');

    if (isset($_POST['login'])){
        unset($_POST['login']);
        AccountController::getInstance()->login($_POST['email']);
    }

    if (isset($_POST['logout'])){
        unset($_POST['logout']);
        AccountController::getInstance()->logout();
    }

    if (isset($_POST['register'])){
        unset($_POST['register']);
        AccountController::getInstance()->register($_POST);
    }

    if (isset($_POST['acceptOrder'])){
        unset($_POST['acceptOrder']);
        OrderController::getInstance()->changeOrderStatus($_POST);
    }

    if (isset($_POST['rejectOrder'])){
        unset($_POST['rejectOrder']);
        OrderController::getInstance()->changeOrderStatus($_POST);
    }

    if (isset($_POST['newOrder'])){
        unset($_POST['newOrder']);
        OrderController::getInstance()->newOrder($_POST);
    }

    if (isset($_POST['addProduct'])){
        unset($_POST['addProduct']);
        require_once('./uploadFile.php');
        $_POST['image_path'] = $target_file;
        ProductController::getInstance()->newProduct($_POST);
    }

    if (isset($_POST['editProduct'])){
        unset($_POST['editProduct']);
        require_once('./uploadFile.php');
        $_POST['image_path'] = $target_file;
        ProductController::getInstance()->editProduct($_POST);
    }

    if (isset($_POST['deleteProduct'])){
        unset($_POST['deleteProduct']);
        ProductController::getInstance()->deleteProduct($_POST['product_id']);
    }

    if (isset($_POST['addToCart'])){
        unset($_POST['addToCart']);
        ProductController::getInstance()->addProductToCart($_POST);
    }

?>