<?php
  session_start();
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
        <input type="text" placeholder="Imię" name="name">
        <input type="text" placeholder="Nazwisko" name="surname">
        <input type="text" placeholder="Kod pocztowy" name="zipcode">
        
        <?php
          require_once '../scripts/connect.php';
          $sql = "SELECT * FROM `cities`";
          $result = $mysqli->query($sql);
          $city = $result->fetch_assoc();
        ?>

        <select name="city_id" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
          <?php
            while ($city = $result->fetch_assoc()) {
              echo "<option value=\"$city[id]\">$city[city]</option>";
            }
          ?>
        </select>
        
        <input type="text" placeholder="Ulica" name="street">
        <input type="text" placeholder="Budynek/Mieszkanie" name="building">
        <input type="text" placeholder="Dodaj komentarz" name="comment">

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
            require_once '../scripts/connect.php';
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
