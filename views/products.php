<?php
  session_start();
  require_once('../controllers/ProductController.php');
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
    <?php 
      require_once './components/menu.php'; 
      if ($_SESSION['success'] != "") {
        echo "<h5 class='p-4 m-4 bg-primary rounded text-white info-message' id='info'>$_SESSION[success]</h5>";
        $_SESSION['success'] = "";
      }    
    ?>
    <div class="container-fluid w-100 bg-dark screen-height text-light menu-buffer">
      <div class="d-flex flex-column text-center py-4 px-lg-4">
        <h3 class="mt-4 pt-4">Wszystkie produkty</h3>
        <?php if (isset($_SESSION['user_id'])) 
        
          $products = ProductController::getProducts();
          
          if(count($products)) {
            echo "<div class='d-flex flex-wrap flex-column flex-lg-row justify-content-center'>";
            foreach($products as $product) {
              if($product['is_available']) {
                $img = "";
                if($product['image_path'])
                  $img = "<img src='$product[image_path]' class='image-medium m-2' />";
                  
                echo <<< INFO
                    <div class="col col-lg-4 bg-info p-2 m-2 rounded">
                      <div class="d-flex flex-column flex-lg-row align-items-center">
                        $img
                        <div class="d-flex flex-column">
                          <a href='./product-details.php?product_id=$product[id]' class='text-decoration-none'><h3>$product[name]</h3></a>
                          <h3>$product[price] zł</h3>
                          <form action="../controllers/handleForm.php" method="post" class="d-flex flex-column">
                            <div class="d-flex flex-row align-items-center">
                              <input type="number" value="$product[id]" hidden="true" name="product_id" />
                              <label for="quantity" class="fs-3 mx-2">Ilość</label>
                              <input type="number" class="form-control m-2" value="1" name="quantity"/>
                            </div>
                            <button type="submit" class="btn btn-primary" name="addToCart">Dodaj do koszyka</button>
                          </form>
                        </div>
                      </div>
                    </div>
INFO;
              }
            }
            echo "</div>";
          } else {
            echo "<h3>Nie odnaleziono produktów</h3>";
          }
        ?>
      </div>
    </div>
    <?php require_once('./components/footer.php'); ?>
    <script src="../scripts/displayInfoMessage.js"></script>
  </body>
</html>
