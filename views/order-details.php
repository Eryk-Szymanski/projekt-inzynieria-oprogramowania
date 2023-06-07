<?php
  session_start();
  require_once('../controllers/OrderController.php');
  require_once('../controllers/ProductController.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Zamówienie</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light menu-buffer py-4">
      <div class="col col-lg-6 bg-warning bg-gradient rounded d-flex flex-column justify-content-center mx-1 my-4 p-4">
        <?php if (isset($_SESSION['success'])) : ?>
          <?php

            require_once './components/menu.php';

            $order = OrderController::getOrder($_GET['number']);
            if ($order) {
              echo <<< INFO
                <h3 class="p-4 m-0 bg-primary bg-gradient rounded">Numer: $order[number]</h3>
                <br>
                <h5 class="px-4">Utworzono: $order[created_at]</h5>
                <div class="d-flex flex-column flex-lg-row">
                  <div class="col col-lg-6 p-4 border-top border-white">
                    <h3>Dane</h3>
                    <h5>Imię: $order[username]</h5>
                    <h5>Nazwisko: $order[surname]</h5>
                    <h5>Email: $order[email]</h5>
                    <h5>Telefon: $order[phone]</h5>
                  </div>
                  <div class="col col-lg-6 p-4 border-top border-white">
                    <h3>Adres</h3>
                    <h5>Kod pocztowy: $order[zipcode]</h5>
                    <h5>Miasto: $order[city]</h5>
                    <h5>Ulica: $order[street]</h5>
                    <h5>Budynek/mieszkanie: $order[apartment]</h5>
                  </div>
                </div>
                <div class="d-flex flex-column flex-lg-row">
                  <div class="col col-lg-6 p-4 border-top border-white">
                    <h3>Dostawa</h3>
                    <h5>$order[name]</h5>
                    <h5>Cena: $order[price] zł</h5>
                    <h5>Szacowany czas dostawy: $order[delivery_time] dni</h5>
                  </div>
                  <div class="col col-lg-6 p-4 border-top border-white">
                    <h3>Płatność</h3>
                    <h5>$order[payment]</h5>
                  </div>
                </div>
                <h3 class="px-4 py-2 border-top border-white w-100">Wartość zamówienia: $order[total_price] zł</h3>
                <h3 class="px-4">Produkty:</h3>
INFO;
              $productsJson = json_decode($order['products'], false);
              $products = ProductController::getOrderProducts($productsJson);
              echo "<div class='m-2 d-flex flex-wrap flex-column flex-lg-row'>";
              foreach ($products as $product) {
                $img = "";
                if($product['image_path'])
                  $img = "<img src='$product[image_path]' class='image-medium' />";
                echo <<<INFO
                <div class="p-4 m-2 bg-info bg-gradient d-flex flex-column rounded">
                  $img
                  <h5>Nazwa: <a href='./product-details.php?product_id=$product[id]' class='text-decoration-none'>$product[name]</a></h5>
                  <h5>Ilość: $product[quantity]</h5>
                  <h5>Cena za sztukę: $product[price] zł</h5>
                  <h5>Cena końcowa: $product[final_price] zł</h5>
                </div>
INFO;
                }
              echo "</div>";
              if (isset($_SESSION['user_role'])) {
                if($_SESSION['user_role'] == 'employee' && $order['status'] == 0) {
                  echo <<< OPTIONS
                  <div class="d-flex flex-column flex-lg-row w-100 justify-content-center">
                    <form action="../controllers/handleForm.php" method="post" class="col col-lg-4 mx-4 my-1">
                      <input type="text" value="accept" hidden="true" name="decision" />
                      <input type="text" value="$_GET[number]" hidden="true" name="number" />
                      <button type="submit" class="w-100 btn btn-success" name="acceptOrder">Zaakceptuj</button>
                    </form>
                    <form action="../controllers/handleForm.php" method="post" class="col col-lg-4 mx-4 my-1">
                      <input type="text" value="reject" hidden="true" name="decision" />
                      <input type="text" value="$_GET[number]" hidden="true" name="number" />
                      <button type="submit" class="w-100 btn btn-danger" name="rejectOrder">Odrzuć</button>
                    </form>
                  </div>
OPTIONS;
                }
              }
            } else {
              echo "<h3>Nie udało się pobrać zamówienia</h3>";
            }
          ?>
        <?php endif ?>
      </div>
    </div>
    <?php require_once('./components/footer.php'); ?>
  </body>
</html>
