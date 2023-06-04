<?php declare(strict_types=1);

if($_SESSION == [])
    session_start();

function addProduct($product) {
    require_once '../../db/ProductRepository.php';
    
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

    header('location: ../../views/products.php');
}

function getProductsAll() {
    require_once '../db/ProductRepository.php';
    $result = getProducts();
    if(isset($result['success'])) {
        echo "<div class='d-flex flex-wrap flex-column flex-lg-row justify-content-center'>";
        while($product = $result['products']->fetch_assoc()) {
            if($product['is_available']) {
            echo <<< INFO
                <div class="col col-lg-4 bg-info p-4 m-4 rounded ">
                <h3>$product[name]</h3>
                <h3>$product[price] zł</h3>
                <form action="../controllers/ProductController/add-to-cart.php" method="post" class="d-flex flex-column flex-lg-row">
                    <input type="number" value="$product[id]" hidden="true" name="product_id" />
                    <label for="quantity">Ilość</label>
                    <input type="number" class="form-control" value="1" name="quantity"/>
                    <button type="submit" class="btn btn-primary m-4">Dodaj do koszyka</button>
                </form>
                </div>
INFO;
            }
        }
        echo "</div>";
    } else {
        echo "<h3>Nie odnaleziono produktów</h3>";
    }
}

function addToCart($product) {
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

    try {
        $_SESSION['cart'][$product['product_id']] = $product['quantity'];

    } catch (Exception $e) {
        echo $e->getMessage();
        $_SESSION['error'] = "Nie dodano produktu";
    }

    header('location: ../../views/products.php');
}

?>