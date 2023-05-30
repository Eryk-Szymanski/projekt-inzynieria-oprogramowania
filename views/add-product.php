<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-shop | Dodaj Produkt</title>
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

        <form action="../scripts/add-product.php" method="post">
            <label for="name">Nazwa</label>
            <input type="text" id="name" name="name" />
            <label for="weight">Waga</label>
            <input type="number" id="weight" name="weight" />
            <label for="is_available" value="is_available">Dostępny</label>
            <input type="checkbox" id="is_available" name="is_available" />
            <label for="description">Opis</label>
            <input type="text" id="description" name="description" />
            <label for="calories">Kalorie</label>
            <input type="number" id="calories" name="calories" />
            <label for="price">Cena</label>
            <input type="number" id="price" name="price" />
            <button type="submit">Dodaj produkt</button>
        </form>

    <?php endif ?>
  </body>
</html>
