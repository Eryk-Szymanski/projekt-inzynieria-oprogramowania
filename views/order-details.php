<?php
  session_start();
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
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light menu-buffer">
      <div class="col col-lg-6 bg-warning bg-gradient rounded d-flex flex-column justify-content-center mx-1 my-4 p-4">
        <?php if (isset($_SESSION['success'])) : ?>
          <?php

            require_once './components/menu.php';

            if (isset($_GET['number'])) {
              require_once '../scripts/connect.php';
              
              // Pobranie zamówienia
              $sql = "SELECT orders.*, users.name, users.surname, users.email, users.phone, addresses.zipcode, addresses.city, addresses.street, addresses.apartment FROM `orders` JOIN `users` ON users.id = orders.user_id JOIN `addresses` ON addresses.id = orders.delivery_address_id WHERE orders.number = $_GET[number]";
              $result = $mysqli->query($sql);
              $order = $result->fetch_assoc();

              echo <<< INFO
                <h3>Numer: $order[number]</h3><br>
                <h5>Imię: $order[name]</h5>
                <h5>Nazwisko: $order[surname]</h5>
                <h5>Email: $order[email]</h5>
                <h5>Telefon: $order[phone]</h5>
                <h5>Kod pocztowy: $order[zipcode]</h5>
                <h5>Miasto: $order[city]</h5>
                <h5>Ulica: $order[street]</h5>
                <h5>Budynek/mieszkanie: $order[apartment]</h5>
                <h5>Wartość zamówienia: $order[total_price] zł</h5><br>
                <h5>Utworzono: $order[created_at]</h5><br>
INFO;
              $products = json_decode($order['products'], false);
              foreach ($products as $product) {
                $sql = "SELECT name, price FROM `products` WHERE id = $product->product_id";
                $result = $mysqli->query($sql);
                $product_data = $result->fetch_assoc();
                $final_price = intval($product->quantity) * intval($product_data['price']);
                echo <<<INFO
                <div class="d-flex flex-column flex-lg-row">
                  <h3>$product_data[name]</h3>
                  <p>$product->quantity</p>
                  <p>$product_data[price]</p>
                  <p>$final_price</p>
                </div>
INFO;
              }
            }
            if (isset($_SESSION['user_role'])) {
              if($_SESSION['user_role'] == 'employee' && $order['status'] == 0) {
                echo <<< ACCEPT
                <form action="../scripts/accept-order.php" method="post">
                  <input type="text" value="accept" hidden="true" name="decision" />
                  <input type="text" value="$_GET[number]" hidden="true" name="number" />
                  <button type="submit" class="btn btn-primary m-4">Zaakceptuj</button>
                </form>
ACCEPT;
                echo <<< REJECT
                <form action="../scripts/accept-order.php" method="post">
                  <input type="text" value="reject" hidden="true" name="decision" />
                  <input type="text" value="$_GET[number]" hidden="true" name="number" />
                  <button type="submit" class="btn btn-primary m-4">Odrzuć</button>
                </form>
REJECT;
              }
            }
          ?>
        <?php endif ?>
      </div>
    </div>
  </body>
</html>
