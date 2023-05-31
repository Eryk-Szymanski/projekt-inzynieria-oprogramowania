<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Logowanie</title>
    <?php
      require_once './style/links.php';
    ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center">
      <?php
        if (isset($_SESSION['success'])) {
          echo <<< INFO
            <h3>Komunikat</h3>
            <div>
              $_SESSION[success]
            </div>
INFO;
          unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
          echo <<< INFO
            <h3>Error</h3>
            <div>
              $_SESSION[error]
            </div>
INFO;
          unset($_SESSION['error']);
        } 
      ?>
      <div class="bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center w-25">

        <img src="./images/logo.png" class="w-50"/>
        <h1><a href="./" class="text-decoration-none fw-bolder">Candy Shop</a></h1>
        <h3>Logowanie</h3>

        <form action="./scripts/login.php" method="post" class="d-flex flex-column">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email">
          <label for="pass">Hasło</label>
          <input type="password" class="form-control" id="pass" name="pass">
          <button type="submit" class="btn btn-primary m-4">Zaloguj</button>
        </form>

        <div class="d-flex flex-row fs-5">
          <a href="./views/forgot-password.php" class="m-2 text-reset">Zapomniane hasło</a>
          <a href="./views/register.php" class="m-2 text-reset">Zarejestruj się</a>
        </div>

      </div>
    </div>
  </body>
</html>
