<?php
  session_start();
  require_once('../controllers/AccountController.php');
  require_once('../controllers/OrderController.php');
  require_once('../controllers/ProductController.php');
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

          <form action="../controllers/handleForm.php" method="post" class="w-100">
            <?php
            
              $user = AccountController::getUser($_SESSION['user_id']);
              $address = AccountController::getAddress($user['address_id']);
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
              $payment_methods = OrderController::getPaymentMethods();
              echo "<div class='d-flex flex-column flex-lg-row'>";
              echo "<div class='col col-lg-6 p-4 border-top border-white'>";
              echo "<h5>Wybierz metodę płatności:</h5>";
              foreach($payment_methods as $payment_method) {
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
              $delivery_methods = OrderController::getDeliveryMethods();
              echo "<div class='col col-lg-6 p-4 border-top border-white'>";
              echo "<h5>Wybierz sposób dostawy:</h5>";
              foreach($delivery_methods as $delivery_method) {
                echo <<< DELIVERY_METHOD
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethod" price="$delivery_method[price]" days="$delivery_method[delivery_time]" value="$delivery_method[id]">
                    <label class="form-check-label" for="deliveryMethod">
                      $delivery_method[name]
                      <br>
                      Cena: $delivery_method[price] zł
                      <br>
                      Przewidywany czas dostawy: $delivery_method[delivery_time] dni
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

              <button type="submit" class="col col-lg-6 btn btn-primary m-2" name="newOrder">Zamów</button>
            </div>
          </form>
          <br>
          <h3 class='px-4'>Produkty:</h3>
          <div class='m-2 d-flex flex-wrap flex-column flex-lg-row'>
          <?php
            if(isset($_SESSION['cart'])) {
              $products = array();
              foreach($_SESSION['cart'] as $key => $value) {
                  $product = array('product_id' => $key, 'quantity' => $value);
                  array_push($products, $product);
              }
              $test = json_encode($products);
              $productsJson = json_decode($test);
              $cart_value = 0;
              $products = ProductController::getOrderProducts($productsJson);
              foreach($products as $product) {
                $cart_value += $product['final_price'];
                $img = "";
                if($product['image_path'])
                  $img = "<img src='$product[image_path]' class='image-medium' />";
                echo <<< PRODUCT
                  <div class='p-4 m-2 bg-info bg-gradient d-flex flex-column rounded'>
                    $img
                    <h5>Nazwa: <a href='./product-details.php?product_id=$product[id]' class='text-decoration-none'>$product[name]</a></h5>
                    <h5>Ilość: $product[quantity]</h5>
                    <h5>Cena za sztukę: $product[price] zł</h5>
                    <h5>Cena końcowa: $product[final_price] zł</h5>
                  </div>
PRODUCT;
              }
              $_SESSION['cart_value'] = $cart_value;
              echo "<p id='cart_value' hidden>$cart_value</p>";
            }
            ?>
          </div>
          <?php if(isset($_SESSION['cart_value'])) 
            echo "<h4 class='px-4' id='final_price'>Cena końcowa: $_SESSION[cart_value] zł</h4>";
            echo "<h4 class='px-4' id='delivery_date'>Przewidywany termin dostawy: " . date("Y-n-j") . "</h4>";
          ?>
        </div>
      <?php endif ?>
    </div>
    <?php require_once('./components/footer.php'); ?>
    <script src="../scripts/deliveryMethodCheckbox.js"></script>
  </body>
</html>
