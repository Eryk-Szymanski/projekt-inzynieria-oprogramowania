<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-shop | Zamówienie</title>
  </head>
  <body>
    <?php if (isset($_SESSION['success'])) : ?>
      <?php
        echo <<< LOGOUT
          <form action="../scripts/logout.php" method="post">
              <button type="submit">Wyloguj</button>
          </form>
LOGOUT;
        if (isset($_GET['number'])) {
          require_once '../scripts/connect.php';
          $sql = "SELECT orders.*, cities.city FROM `orders` JOIN `cities` ON cities.id = orders.city_id WHERE `number` = $_GET[number]";
          $result = $mysqli->query($sql);
          $order = $result->fetch_assoc();
          echo <<< INFO
            <h3>Numer: $order[number]</h3><br>
            <h5>Zamawiający: $order[name] $order[surname]</h5><br> 
            <h5>Adres: $order[zipcode] $order[city]</h5><br>
            <h5>$order[street] $order[building]</h5><br>
            <h5>Wartość zamówienia: $order[final_price] zł</h5><br>
            <h5>Utworzono: $order[created_at]</h5><br>
            <table>
              <tr>
                <th>Nazwa</th>
                <th>Ilość</th>
                <th>Cena jednostkowa</th>
                <th>Cena końcowa</th>
              </tr>
INFO;
          $products = json_decode($order['products'], false);
          foreach ($products as $product) {
            $sql = "SELECT name, price FROM `products` WHERE id = $product->product_id";
            $result = $mysqli->query($sql);
            $product_data = $result->fetch_assoc();
            $final_price = intval($product->quantity) * intval($product_data['price']);
            echo <<<INFO
            <tr>
              <td>$product_data[name]</td>
              <td>$product->quantity</td>
              <td>$product_data[price]</td>
              <td>$final_price</td>
            </tr>
INFO;
          }
          echo "</table>";
        }
        if (isset($_SESSION['user_role'])) {
          if($_SESSION['user_role'] == 'superuser') {
            echo <<< ACCEPT
            <form action="../scripts/accept-order.php" method="post">
              <input type="text" value="accept" hidden="true" name="decision" />
              <input type="text" value="$_GET[number]" hidden="true" name="number" />
              <button type="submit">Zaakceptuj</button>
            </form>
ACCEPT;
            echo <<< REJECT
            <form action="../scripts/accept-order.php" method="post">
              <input type="text" value="reject" hidden="true" name="decision" />
              <input type="text" value="$_GET[number]" hidden="true" name="number" />
              <button type="submit">Odrzuć</button>
            </form>
REJECT;
          }
        }
      ?>
    <?php endif ?>
  </body>
</html>
