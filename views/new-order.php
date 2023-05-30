<?php
  session_start();
  require_once '../scripts/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-shop | Nowe Zamówienie</title>
  </head>
  <body>
    <?php if (isset($_SESSION['success'])) : ?>
      <?php 
        echo <<< LOGOUT
          <form action="../scripts/logout.php" method="post">
              <button type="submit">Wyloguj</button>
          </form>
LOGOUT;
      ?>

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
              <label>
                <input type="radio" name="paymentMethod" value="$payment_method[id]"> $payment_method[name] 
              </label>
PAYMENT_METHOD;
          }

// Sposób dostawy  
          $sql = "SELECT * FROM `delivery_methods`";
          $result = $mysqli->query($sql);
          echo "<h5>Wybierz sposób dostawy:</h5>";
          while($delivery_method = $result->fetch_assoc()) {
            echo <<< DELIVERY_METHOD
              <label>
                <input type="radio" name="deliveryMethod" value="$delivery_method[id]"> $delivery_method[name] 
              </label>
DELIVERY_METHOD;
          }
        ?>
        
        <input type="text" placeholder="Dodaj komentarz" name="comments">

        <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree">
        <label for="agreeTerms">
          Zatwierdzam <a href="#">regulamin</a>
        </label>

        <button type="submit">Zamów</button>
      </form>

      <table>
        <tr>
          <th>Produkt</th>
          <th>Ilość</th>
          <th>Cena za sztukę</th>
          <th>Cena całkowita</th>
        </tr>

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
              <tr>
                <td>$product[name]</td>
                <td>$value</td>
                <td>$product[price] zł</td>
                <td>$final_price zł</td>
              </tr>
INFO;
            }
            $_SESSION['cart_value'] = $cart_value;
            echo "<h7>Cena końcowa: $_SESSION[cart_value] zł</h7>";
          }
        ?>
      </table>
    <?php endif ?>
  </body>
</html>
