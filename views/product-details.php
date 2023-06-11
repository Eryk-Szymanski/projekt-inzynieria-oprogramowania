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
      <div class="col col-lg-6 bg-dark bg-gradient border border-primary rounded d-flex flex-column justify-content-center mx-1 my-4 p-4">
        <?php if (isset($_SESSION['user_id'])) : ?>
          <?php

            require_once './components/menu.php';

            $product = ProductController::getInstance()->getProductDetails($_GET['product_id']);
            if ($product) {
                $available = "<i class='bi bi-x-square-fill text-danger mx-2'></i>Niedostępny";
                if($product['is_available'] == 1)
                    $available = "<i class='bi bi-check-square-fill text-success mx-2'></i>Dostępny";
                $img = "";
                if($product['image_path'])
                  $img = "<img src='$product[image_path]' class='image-medium rounded' />";
                
                if ($_SESSION['user_role'] == 'employee') {
                  echo <<< EMPLOYEE_OPTIONS
                    <div class="d-flex flex-column flex-lg-row justify-content-center my-2">
                      <a href='./edit-product.php?product_id=$product[id]' class='col col-lg-4 btn btn-primary text-decoration-none mx-2 my-1'><i class='bi bi-pencil-fill'></i> Edytuj</a>
                      <form action="../scripts/handleForm.php" method="post" class="col col-lg-4 mx-2 my-1">
                        <input type="number" value="$product[id]" hidden="true" name="product_id" />
                        <button type="submit" class="w-100 btn btn-danger" name="deleteProduct"><i class="bi bi-trash3-fill"></i> Usuń</button>
                      </form>
                    </div>
EMPLOYEE_OPTIONS;
                }
                echo <<< INFO
                  <div class="d-flex flex-column flex-lg-row my-2">
                    <div class="d-flex flex-column">
                      $img
                      <form action="../scripts/handleForm.php" method="post" class="d-flex flex-column">
                        <div class="d-flex flex-row align-items-center">
                          <input type="text" value="$product[name]" hidden="true" name="name" />
                          <input type="number" value="$product[id]" hidden="true" name="product_id" />
                          <label for="quantity" class="fs-3 mx-2">Ilość</label>
                          <input type="number" class="form-control m-2" value="1" name="quantity"/>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addToCart">Dodaj do koszyka</button>
                      </form>
                    </div>
                    <div class="m-4">
                      <h3>Detale produktu</h3>
                      <h1>$product[name]</h1>
                      <h5>Waga: $product[weight]</h5>
                      <h5>$available</h5>
                      <h5>Opis: $product[description]</h5>
                      <h5>Kalorie: $product[calories]</h5>
                      <h5>Cena: $product[price] zł</h5> 
                    </div>
                  </div>
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
