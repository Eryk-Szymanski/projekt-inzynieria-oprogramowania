<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Produkty</title>
    <?php
      require_once '../style/links.php';
    ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light">
      <div class="d-flex flex-column">
        <?php if (isset($_SESSION['success'])) : ?>
          <?php

            require_once './components/menu.php';

            if ($_SESSION['user_role'] == 'employee')
              echo "<a href='./add-product.php' class='btn btn-primary m-4'>Dodaj produkt</a>";
          ?>

          
          <?php
            require_once '../scripts/connect.php';
            $sql = "SELECT * FROM `products`";
            $result = $mysqli->query($sql);
            echo "<table>";
            while($product = $result->fetch_assoc()) {
              if($product['is_available']) {
                echo <<< INFO
                <tr>
                  <td>
                    <h3>$product[name]</h3>
                  </td>
                  <td>$product[price] zł</td>
                  <form action="../scripts/add-to-cart.php" method="post">
                    <td class="d-flex flex-row">    
                      <input type="number" value="$product[id]" hidden="true" name="product_id" />
                      <label for="quantity">Ilość</label>
                      <input type="number" class="form-control" value="1" name="quantity"/>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-primary m-4">Dodaj do koszyka</button>
                    </td>
                  </form>
                </tr>
INFO;
              }
            }
            echo "</table>";
          ?>
        <?php endif ?>
      </div>
    </div>
  </body>
</html>
