<?php declare(strict_types=1);

if($_SESSION == [])
    session_start();

require_once '../../db/OrderRepository.php';

function registerOrder($order) {

    $error = 0;
    foreach ($order as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if (!isset($order['agreeTerms'])) {
        $error = 1;
    }

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
        $_SESSION['error'] = $result['error'];
        header('location: ../');
        exit();
    } 

    unset($_SESSION['cart']);
    unset($_SESSION['cart_value']);

    header('location: ../../views/logged.php');
}

function acceptRejectOrder($data) {
    
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

    if(isset($data['decision'])) {
        $decision = 0;
        switch($_POST['decision']) {
            case 'accept':
                $decision = 1;
                break;
            case 'reject':
                $decision = 2;
                break;
        }
        changeOrderStatus($data['number'], $decision);
    }

    header('location: ../../views/logged.php');
}

?>