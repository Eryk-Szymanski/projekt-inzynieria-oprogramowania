<?php declare(strict_types=1);

function createOrder($order) {
    require_once 'connect.php';

    $error = 0;
    try {
        $stmt = $mysqli->prepare("INSERT INTO `orders` (`number`, `user_id`, `products`, `payment_method_id`, `delivery_method_id`, `delivery_address_id`, `total_price`, `comments`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sisiiids", $order['number'], $order['user_id'], $order['products'], $order['paymentMethod'], $order['deliveryMethod'], $order['address_id'], $order['cart_value'], $order['comments']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return ["success" => true];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie utworzono zamówienia $order[number]";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function changeOrderStatus($orderNumber, $decision) {
    require_once 'connect.php';

    $error = 0;
    try {
        $stmt = $mysqli->prepare("UPDATE orders SET status = ? WHERE number = $orderNumber");
        $stmt->bind_param("i", $decision);
        $stmt->execute();
    
        if ($stmt->affected_rows == 1) {
            return ["success" => true];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się zmienić statusu zamówienia $orderNumber";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

?>