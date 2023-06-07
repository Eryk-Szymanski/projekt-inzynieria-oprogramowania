<?php
  session_start();
  require_once('../controllers/ProductController.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Produkt</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light menu-buffer py-4">
      <div class="col col-lg-6 bg-info bg-gradient rounded d-flex flex-column justify-content-center mx-1 my-4 p-4">
        <?php if (isset($_SESSION['success'])) : ?>
          <?php

            require_once './components/menu.php';

            $product = ProductController::getProductDetails($_GET['product_id']);
            if ($product) {
                $available = "<i class='bi bi-x-square-fill text-danger mx-2'></i>Niedostępny";
                if($product['is_available'] == 1)
                    $available = "<i class='bi bi-check-square-fill text-success mx-2'></i>Dostępny";
              echo <<< INFO
                <h3>Detale produktu</h3>
                <h1>$product[name]</h1>
                <h5>Waga: $product[weight]</h5>
                <h5>$available</h5>
                <h5>Opis: $product[description]</h5>
                <h5>Kalorie: $product[calories]</h5>
                <h5>Cena: $product[price] zł</h5>
INFO;
            } else {
              echo "<h3>Nie udało się pobrać detali produktu</h3>";
            }
          ?>
        <?php endif ?>
      </div>
    </div>
    <?php require_once('./components/footer.php'); ?>
  </body>
</html>
