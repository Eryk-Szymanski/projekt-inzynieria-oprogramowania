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
        <?php if (isset($_SESSION['success'])) 
            require_once('../controllers/ProductController/get-products.php');
        ?>
      </div>
    </div>
  </body>
</html>
