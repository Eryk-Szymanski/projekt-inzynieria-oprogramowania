<?php declare(strict_types=1);

function registerOrder($order) {
    require_once '../db/OrderRepository.php';

    $error = 0;
    foreach ($order as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if (!isset($order['agreeTerms'])) {
        $error = 1;
    }

    session_start();

    if(!isset($_SESSION['cart'])) {
        $error = 1;
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }
    
    $order['number'] = strval(date("YmdHms"));
    $products = array();
    foreach($_SESSION['cart'] as $key => $value) {
        $product = array('product_id' => $key, 'quantity' => $value);
        array_push($products, $product);
    }
    $order['products'] = json_encode($products);
    $order['cart_value'] = $_SESSION['cart_value'];

    $result = createOrder($order);
    if(isset($result['error'])) {
        echo $result['error'];
        $_SESSION['error'] = $result['error'];
        header('location: ../');
        exit();
    } else {
        unset($_SESSION['cart']);
        unset($_SESSION['cart_value']);
        $_SESSION['success'] = "Prawidłowo utworzono zamówienie";
    }

    header('location: ../views/logged.php');
}

function acceptRejectOrder($data) {
    require_once '../db/OrderRepository.php';
    
    $error = 0;
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if(!isset($data['number'])) {
        $error = 1;
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    session_start();

    if(isset($data['decision'])) {
        $decision = 0;
        switch($_POST['decision']) {
            case 'accept':
                $decision = 2;
                break;
            case 'reject':
                $decision = 3;
                break;
        }
        $result = changeOrderStatus($data['number'], $decision);
        if(isset($result['error'])) {
            echo $result['error'];
            $_SESSION['error'] = $result['error'];
            header('location: ../');
            exit();
        } else {
            $_SESSION['success'] = "Prawidłowo zmieniono status zamówienia";
        }
    }

    header('location: ../views/logged.php');
}

function getOneOrder($orderNumber) {
    require_once '../db/OrderRepository.php';
    $result = getOrder($orderNumber);
    if(isset($result['success'])) {
        return $result['order'];
    }
    return null;
}

function getPaymentMethodsData() {
    require_once '../db/OrderRepository.php';
    $result = getPaymentMethods();
    if(isset($result['success'])) {
        return $result['payment_methods'];
    }
    return null;
}

function getDeliveryMethodsData() {
    require_once '../db/OrderRepository.php';
    $result = getDeliveryMethods();
    if(isset($result['success'])) {
        return $result['delivery_methods'];
    }
    return null;
}

function getUserOrdersData($user_id) {
    require_once '../db/OrderRepository.php';
    $result = getUserOrders($user_id);
    if(isset($result['success'])) {
        return $result['orders'];
    }
    return null;
}

function getOrdersDataByStatus($status) {
    require_once '../db/OrderRepository.php';
    $result = getOrdersByStatus($status);
    if(isset($result['success'])) {
        return $result['orders'];
    }
    return null;
}

?>