<?php declare(strict_types=1);

function createOrder($order) {
    require_once 'connect.php';

    $error = 0;
    try {
        $status_id = 1;
        $stmt = $mysqli->prepare("INSERT INTO `orders` (`number`, `user_id`, `products`, `payment_method_id`, `delivery_method_id`, `delivery_address_id`, `total_price`, `comments`, `status_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sisiiidsi", $order['number'], $order['user_id'], $order['products'], $order['paymentMethod'], $order['deliveryMethod'], $order['address_id'], $order['cart_value'], $order['comments'], $status_id);
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
        $stmt = $mysqli->prepare("UPDATE orders SET status_id = ? WHERE number = $orderNumber");
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

function getOrder($orderNumber) {
    require_once 'connect.php';

    $error = 0;
    try {
        $sql = "SELECT 
            orders.*, 
            users.name as username, 
            users.surname, 
            users.email, 
            users.phone, 
            addresses.zipcode, 
            addresses.city, 
            addresses.street, 
            addresses.apartment,
            payment_methods.name as payment,
            delivery_methods.*,
            order_statuses.name as status
            FROM `orders` 
            JOIN `users` 
            ON users.id = orders.user_id 
            JOIN `addresses` 
            ON addresses.id = orders.delivery_address_id 
            JOIN `payment_methods` 
            ON payment_methods.id = orders.payment_method_id 
            JOIN `delivery_methods` 
            ON delivery_methods.id = orders.delivery_method_id 
            JOIN `order_statuses` 
            ON order_statuses.id = orders.status_id 
            WHERE orders.number = $orderNumber";
        $result = $mysqli->query($sql);
        $order = $result->fetch_assoc();
    
        if ($order) {
            return ["success" => true, "order" => $order];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się pobrać zamówienia $orderNumber";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getPaymentMethods() {
    $mysqli = new mysqli("localhost", "root", "", "inzynieria-oprogramowania-db");

    $error = 0;
    try {
        $sql = "SELECT * FROM `payment_methods`";
        $result = $mysqli->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
    
        if ($rows) {
            return ["success" => true, "payment_methods" => $rows];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się pobrać metod płatności";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getDeliveryMethods() {
    $mysqli = new mysqli("localhost", "root", "", "inzynieria-oprogramowania-db");

    $error = 0;
    try {
        $sql = "SELECT * FROM `delivery_methods`";
        $result = $mysqli->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
    
        if ($rows) {
            return ["success" => true, "delivery_methods" => $rows];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się pobrać metod dostawy";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getUserOrders($user_id) {
    $mysqli = new mysqli("localhost", "root", "", "inzynieria-oprogramowania-db");

    $error = 0;
    try {
        $sql = "SELECT number, status_id FROM `orders` WHERE `user_id` = $user_id";
        $result = $mysqli->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
    
        if ($rows) {
            return ["success" => true, "orders" => $rows];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się pobrać zamówień";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getOrdersByStatus($status_id) {
    $mysqli = new mysqli("localhost", "root", "", "inzynieria-oprogramowania-db");

    $error = 0;
    try {
        $sql = "SELECT orders.number FROM `orders` WHERE `status_id` = $status_id";
        $result = $mysqli->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
    
        if ($rows) {
            return ["success" => true, "orders" => $rows];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się pobrać zamówień";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

?>