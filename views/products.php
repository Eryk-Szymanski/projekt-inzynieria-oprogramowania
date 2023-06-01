<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Produkty</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <?php require_once './components/menu.php'; ?>
    <div class="container-fluid w-100 bg-dark screen-height text-light menu-buffer">
      <div class="d-flex flex-column text-center">
        <h3 class="mt-4 pt-4">Wszystkie produkty</h3>
        <?php if (isset($_SESSION['success'])) {
            require_once '../scripts/connect.php';
            $sql = "SELECT * FROM `products`";
            $result = $mysqli->query($sql);
            echo "<div class='d-flex flex-wrap flex-column flex-lg-row justify-content-center'>";
            while($product = $result->fetch_assoc()) {
              if($product['is_available']) {
                echo <<< INFO
                  <div class="col col-lg-4 bg-info p-4 m-4 rounded ">
                    <h3>$product[name]</h3>
                    <h3>$product[price] zł</h3>
                    <form action="../scripts/add-to-cart.php" method="post" class="d-flex flex-column flex-lg-row">
                      <input type="number" value="$product[id]" hidden="true" name="product_id" />
                      <label for="quantity">Ilość</label>
                      <input type="number" class="form-control" value="1" name="quantity"/>
                      <button type="submit" class="btn btn-primary m-4">Dodaj do koszyka</button>
                    </form>
                  </div>
INFO;
              }
            }
            echo "</div>";
          } 
        ?>
      </div>
    </div>
  </body>
</html>
