<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Dodaj Produkt</title>
    <?php
      require_once '../style/links.php';
    ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light">
      <?php if (isset($_SESSION['success'])) : ?>

        <?php require_once './components/menu.php'; ?>
        
        <div class="bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center w-25 p-4">
          <h3>Nowy produkt</h3>
          <form action="../scripts/add-product.php" method="post">
              <label for="name">Nazwa</label>
              <input type="text" class="form-control" id="name" name="name" />
              <label for="weight">Waga</label>
              <input type="number" class="form-control" id="weight" name="weight" />
              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="checkbox" class="btn-check" id="is_available" name="is_available" autocomplete="off" value="is_available">
                <label class="btn btn-outline-primary" for="is_available" value="is_available">
                  Dostępny
                </label>
              </div>
              <br>
              <label for="description">Opis</label>
              <input type="text" class="form-control" id="description" name="description" />
              <label for="calories">Kalorie</label>
              <input type="number" class="form-control" id="calories" name="calories" />
              <label for="price">Cena</label>
              <input type="number" class="form-control" id="price" name="price" />
              <button type="submit" class="btn btn-primary m-4">Dodaj produkt</button>
          </form>
        </div>

      <?php endif ?>
    </div>
  </body>
</html>
