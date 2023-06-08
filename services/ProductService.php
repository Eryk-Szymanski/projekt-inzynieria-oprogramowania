<?php declare(strict_types=1);

function addProduct($product) {
    require_once '../db/ProductRepository.php';
    
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

    $result = createProduct($product);
    if(isset($result['error']))
        $_SESSION['error'] = $result['error'];
    
    $_SESSION['success'] = "Prawidłowo dodano produkt";
    header('location: ../views/products.php');
}

function updateProduct($product) {
    require_once '../db/ProductRepository.php';
    
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

    $result = changeProduct($product);
    if(isset($result['error']))
        $_SESSION['error'] = $result['error'];
    
    $_SESSION['success'] = "Prawidłowo zaktualizowano produkt";
    header('location: ../views/products.php');
}

function removeProduct($product_id) {
    require_once '../db/ProductRepository.php';
    
    $error = 0;
    if (empty($product_id)) {
        $error = 1;
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    $result = deleteProduct($product_id);
    if(isset($result['error']))
        $_SESSION['error'] = $result['error'];
    else {
        $_SESSION['success'] = "Prawidłowo usunięto produkt";
        header('location: ../views/products.php');
        exit();
    }

    header('location: ../');
}

function getProductsAll() {
    require_once '../db/ProductRepository.php';
    $result = getProducts();
    if(isset($result['success'])) {
        return $result['products'];
    }
    return null;
}


function getProductDetails($product_id) {
    require_once '../db/ProductRepository.php';
    $result = getProductData($product_id);
    if(isset($result['success'])) {
        return $result['product'];
    }
    return null;
}

function getOrderProducts($productsJson) {
    require_once '../db/ProductRepository.php';
    $products = [];
    foreach($productsJson as $productJson) {
        $result = getProduct($productJson->product_id);
        if(isset($result['success'])) {
            $result['product']['quantity'] = $productJson->quantity;
            $result['product']['final_price'] = intval($productJson->quantity) * intval($result['product']['price']);
            array_push($products, $result['product']);
        }
    }
    return $products;
}

function addToCart($product) {
    $error = 0;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    session_start();

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    try {
        $_SESSION['cart'][$product['product_id']] = $product['quantity'];

    } catch (Exception $e) {
        echo $e->getMessage();
        $_SESSION['error'] = "Nie dodano produktu";
    }

    header('location: ../views/products.php');
}

?>