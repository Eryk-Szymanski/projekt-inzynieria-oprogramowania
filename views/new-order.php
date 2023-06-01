<?php
  session_start();
  require_once '../scripts/connect.php';
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
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center text-light menu-buffer">
      <?php if (isset($_SESSION['success'])) : ?>
        <?php require_once './components/menu.php'; ?>
        <div class="col col-lg-6 p-4 mx-1 my-4 bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center">
          <h3>Nowe zamówienie</h3>

          <form action="../scripts/new-order.php" method="post">
            <?php

// Informacje o kliencie
              $sql = "SELECT id, name, surname, email, phone, address_id FROM `users` WHERE id = $_SESSION[user_id]";
              $result = $mysqli->query($sql);
              $user = $result->fetch_assoc();
              echo <<< USER_DATA
                <input type="number" value="$user[id]" name="user_id" hidden />
                <input type="number" value="$user[address_id]" name="address_id" hidden />
                <h5>Imię: $user[name]</h5>
                <h5>Nazwisko: $user[surname]</h5>
                <h5>Email: $user[email]</h5>
                <h5>Telefon: $user[phone]</h5>
USER_DATA;

// Informacje o adresie dostawy
              $sql = "SELECT zipcode, city, street, apartment FROM `addresses` WHERE id = $user[address_id]";
              $result = $mysqli->query($sql);
              $address = $result->fetch_assoc();
              echo <<< USER_ADDRESS
                <h5>Kod pocztowy: $address[zipcode]</h5>
                <h5>Miasto: $address[city]</h5>
                <h5>Ulica: $address[street]</h5>
                <h5>Budynek/mieszkanie: $address[apartment]</h5>
USER_ADDRESS;

// Metoda płatności
              $sql = "SELECT * FROM `payment_methods`";
              $result = $mysqli->query($sql);
              echo "<h5>Wybierz metodę płatności:</h5>";
              while($payment_method = $result->fetch_assoc()) {
                echo <<< PAYMENT_METHOD
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod" value="$payment_method[id]">
                  <label class="form-check-label" for="paymentMethod">
                    $payment_method[name]
                  </label>
                </div>
PAYMENT_METHOD;
              }

// Sposób dostawy  
              $sql = "SELECT * FROM `delivery_methods`";
              $result = $mysqli->query($sql);
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
            
            <input type="text" class="form-control" placeholder="Dodaj komentarz" name="comments">

            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
              <input type="checkbox" class="btn-check" id="agreeTerms" name="agreeTerms" autocomplete="off" value="agree">
              <label class="btn btn-outline-primary" for="agreeTerms">
                Zatwierdzam <a href="#">regulamin</a>
              </label>
            </div>

            <button type="submit" class="btn btn-primary m-4">Zamów</button>
          </form>

          <h1>Produkty<h1>
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
                <div class="d-flex flex-column flex-lg-row">
                  <h3>$product[name]</h3>
                  <p>$value</p>
                  <p>$product[price] zł</p>
                  <p>$final_price zł</p>
                </div>
INFO;
              }
              $_SESSION['cart_value'] = $cart_value;
              echo "<h7>Cena końcowa: $_SESSION[cart_value] zł</h7>";
            }
          ?>
          </table>
        </div>
      <?php endif ?>
    </div>
  </body>
</html>
