<?php declare(strict_types=1);

function createProduct($product) {
    require_once 'connect.php';

    $error = 0;
    try {
        $is_available = 0;
        if(isset($product['is_available']))
            $is_available = 1;
        $stmt = $mysqli->prepare("INSERT INTO products(name, weight, is_available, description, calories, price, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siisiis", $product['name'], $product['weight'], $is_available, $product['description'], $product['calories'], $product['price'], $product['image_path']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return ["success" => true];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie utworzono produktu $product[name]";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function changeProduct($product) {
    require_once 'connect.php';

    $error = 0;
    try {
        $is_available = 0;
        if(isset($product['is_available']))
            $is_available = 1;
        $stmt = $mysqli->prepare("UPDATE products SET name = ?, weight = ?, is_available = ?, description = ?, calories = ?, price = ?, image_path = ? WHERE id = $product[product_id]");
        $stmt->bind_param("siisiis", $product['name'], $product['weight'], $is_available, $product['description'], $product['calories'], $product['price'], $product['image_path']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return ["success" => true];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie zaktualizowano produktu $product[name]";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function deleteProduct($product_id) {
    require_once 'connect.php';

    $error = 0;
    try {
        $stmt = $mysqli->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return ["success" => true];
        }

    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie usunięto produktu $product[name]";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getProducts() {
    require_once 'connect.php';

    $error = 0;
    $products = [];
    try {
        $sql = "SELECT * FROM `products`";
        $result = $mysqli->query($sql);
        while($product = $result->fetch_assoc()) {
            array_push($products, $product);
        }
        return ["success" => true, "products" => $products];
    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie udało się pobrać produktów";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getProduct($product_id) {
    $mysqli = new mysqli("localhost", "root", "", "inzynieria-oprogramowania-db");

    $error = 0;
    try {
        $sql = "SELECT id, name, price, image_path FROM `products` WHERE id = $product_id";
        $result = $mysqli->query($sql);
        $product = $result->fetch_assoc();

        return ["success" => true, "product" => $product];
    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie odnaleziono produktu";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

function getProductData($product_id) {
    $mysqli = new mysqli("localhost", "root", "", "inzynieria-oprogramowania-db");

    $error = 0;
    try {
        $sql = "SELECT * FROM `products` WHERE id = $product_id";
        $result = $mysqli->query($sql);
        $product = $result->fetch_assoc();

        return ["success" => true, "product" => $product];
    } catch (Exception $e) {
        if($stmt->affected_rows != 1) {
            $error = "Nie odnaleziono produktu";
        }
        $error = $error . "Message: " . $e->getMessage();
    }
    return ["error" => $error];
}

?>