<?php
  session_start();
  require_once('../controllers/ProductController.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Edytuj Produkt</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light menu-buffer">
      <?php if (isset($_SESSION['success'])) {

        require_once './components/menu.php'; 
        $product = ProductController::getProductDetails($_GET['product_id']); 
        $img = "";
        if($product['image_path'])
            $img = "<img src='$product[image_path]' class='image-medium' />";
        $checked = "";
        if($product['is_available'])
            $checked = "checked";
        echo <<< FORM
        <div class="col col-lg-3 bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center w-25 p-4">
          <h3 class="p-2">Edytuj produkt</h3>
          <form action="../controllers/handleForm.php" method="post" enctype="multipart/form-data" class="p-2 border-top border-white">
            <input type="number" id="product_id" name="product_id" value="$product[id]" hidden/>
            <label for="name">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="$product[name]"/>
            <label for="weight">Waga</label>
            <input type="number" class="form-control" id="weight" name="weight" value="$product[weight]"/>
            <div class="btn-group my-2 w-100" role="group" aria-label="Basic radio toggle button group">
              <input type="checkbox" class="btn-check" id="is_available" name="is_available" autocomplete="off" value="is_available" $checked>
              <label class="btn btn-outline-primary" for="is_available" value="is_available">
                Dostępny
              </label>
            </div>
            <br>
            <label for="description">Opis</label>
            <input type="text" class="form-control" id="description" name="description" value="$product[description]"/>
            <label for="calories">Kalorie</label>
            <input type="number" class="form-control" id="calories" name="calories" value="$product[calories]"/>
            <label for="price">Cena</label>
            <input type="number" class="form-control" id="price" name="price" value="$product[price]"/>
            <label for="photo">Zdjęcie</label>
            $img
            <input type="file" name="photo" id="photo">
            <button type="submit" class="btn btn-primary my-4 w-100" name="editProduct">Edytuj produkt</button>
          </form>
        </div>
FORM;
      } 
      ?>
    </div>
    <?php require_once('./components/footer.php'); ?>
  </body>
</html>
