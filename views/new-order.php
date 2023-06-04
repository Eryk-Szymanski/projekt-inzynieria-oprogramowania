<?php
  session_start();
  require_once '../db/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Nowe Zamówienie</title>
    <?php
      require_once '../style/links.php';
    ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center text-light menu-buffer py-4">
      <?php if (isset($_SESSION['success'])) : ?>
        <?php require_once './components/menu.php'; ?>
        <div class="col col-lg-6 p-4 mx-1 my-4 bg-warning bg-gradient rounded d-flex flex-column">
          <h3 class="px-4 py-2">Nowe zamówienie</h3>

          <form action="../controllers/OrderController/new-order.php" method="post" class="w-100">
            <?php

// Informacje o kliencie
              $sql = "SELECT id, name, surname, email, phone, address_id FROM `users` WHERE id = $_SESSION[user_id]";
              $result = $mysqli->query($sql);
              $user = $result->fetch_assoc();

// Informacje o adresie dostawy
              $sql = "SELECT zipcode, city, street, apartment FROM `addresses` WHERE id = $user[address_id]";
              $result = $mysqli->query($sql);
              $address = $result->fetch_assoc();
              echo <<< USER_DATA
                <div class="d-flex flex-column flex-lg-row">
                  <div class="col col-lg-6 p-4 border-top border-white">
                    <input type="number" value="$user[id]" name="user_id" hidden />
                    <input type="number" value="$user[address_id]" name="address_id" hidden />
                    <h3>Dane</h3>
                    <h5>Imię: $user[name]</h5>
                    <h5>Nazwisko: $user[surname]</h5>
                    <h5>Email: $user[email]</h5>
                    <h5>Telefon: $user[phone]</h5>
                  </div>
                  <div class="col col-lg-6 p-4 border-top border-white">
                    <h3>Adres</h3>
                    <h5>Kod pocztowy: $address[zipcode]</h5>
                    <h5>Miasto: $address[city]</h5>
                    <h5>Ulica: $address[street]</h5>
                    <h5>Budynek/mieszkanie: $address[apartment]</h5>
                  </div>
                </div>
USER_DATA;

// Metoda płatności
              $sql = "SELECT * FROM `payment_methods`";
              $result = $mysqli->query($sql);
              echo "<div class='d-flex flex-column flex-lg-row'>";
              echo "<div class='col col-lg-6 p-4 border-top border-white'>";
              echo "<h5>Wybierz metodę płatności:</h5>";
              while($payment_method = $result->fetch_assoc()) {
                echo <<<PAYMENT_METHOD
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod" value="$payment_method[id]">
                    <label class="form-check-label" for="paymentMethod">
                      $payment_method[name]
                    </label>
                  </div>
PAYMENT_METHOD;
              }
              echo "</div>";
// Sposób dostawy  
              $sql = "SELECT * FROM `delivery_methods`";
              $result = $mysqli->query($sql);
              echo "<div class='col col-lg-6 p-4 border-top border-white'>";
              echo "<h5>Wybierz sposób dostawy:</h5>";
              while($delivery_method = $result->fetch_assoc()) {
                echo <<< DELIVERY_METHOD
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethod" value="$delivery_method[id]">
                    <label class="form-check-label" for="deliveryMethod">
                      $delivery_method[name]
                    </label>
                  </div>
DELIVERY_METHOD;
              }
            ?>
            </div>
            </div>
            <input type="text" class="form-control my-2" placeholder="Dodaj komentarz" name="comments">

            <div class="d-flex flex-column flex-lg-row w-100 justify-content-center">
              <div class="col col-lg-4 btn-group m-2" role="group" aria-label="Basic radio toggle button group">
                <input type="checkbox" class="btn-check" id="agreeTerms" name="agreeTerms" autocomplete="off" value="agree">
                <label class="btn btn-outline-primary" for="agreeTerms">
                  Zatwierdzam <a href="#" class="text-reset text-decoration-none fw-bolder">regulamin</a>
                </label>
              </div>

              <button type="submit" class="col col-lg-6 btn btn-primary m-2">Zamów</button>
            </div>
          </form>
          <br>
          <h3 class="px-4">Produkty:</h3>
          <div class='m-2 d-flex flex-wrap flex-column flex-lg-row'>
          <?php
            if(isset($_SESSION['cart'])) {
              $cart_value = 0;
              foreach($_SESSION['cart'] as $key => $value) {
                $sql = "SELECT name, price FROM `products` WHERE id = $key";
                $result = $mysqli->query($sql);
                $product = $result->fetch_assoc();
                $final_price = intval($value) * intval($product['price']);
                $cart_value += $final_price;
                echo <<< INFO
                <div class="p-4 m-2 bg-info bg-gradient d-flex flex-column rounded">
                  <h5>Nazwa: $product[name]</h5>
                  <h5>Ilość: $value</h5>
                  <h5>Cena za sztukę: $product[price] zł</h5>
                  <h5>Cena końcowa: $final_price zł</h5>
                </div>
INFO;
              }
              $_SESSION['cart_value'] = $cart_value;
            }
            ?>
          </div>
          <?php if(isset($_SESSION['cart_value'])) 
            echo "<h4 class='px-4'>Cena końcowa: $_SESSION[cart_value] zł</h4>" ?>
        </div>
      <?php endif ?>
    </div>
  </body>
</html>
