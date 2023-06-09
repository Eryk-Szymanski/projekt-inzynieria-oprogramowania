<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Logowanie</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <?php
      if (isset($_SESSION['success'])) {
        echo "<h5 class='p-4 m-4 bg-primary rounded text-white info-message' id='info'>$_SESSION[success]</h5>";
        unset($_SESSION['success']);
      } 
    ?>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center">
      <div class="col col-lg-3 bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center">

        <img src="../images/logo.png" class="image-medium"/>
        <h1><a href="./" class="text-decoration-none fw-bolder">Candy Shop</a></h1>
        <h3 class="p-2">Logowanie</h3>

        <form action="../scripts/handleForm.php" method="post" class="d-flex flex-column p-2 border-top border-white">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email">
          <label for="pass">Hasło</label>
          <input type="password" class="form-control" id="pass" name="pass">
          <button type="submit" class="btn btn-primary my-4 w-100" name="login">Zaloguj</button>
        </form>

        <div class="d-flex flex-column flex-lg-row fs-5">
          <a href="./forgot-password.php" class="m-2 text-reset">Zapomniane hasło</a>
          <a href="./register.php" class="m-2 text-reset">Zarejestruj się</a>
        </div>

      </div>
    </div>
    <?php require_once('./components/footer.php'); ?>
    <script src="../js/displayInfoMessage.js"></script>
  </body>
</html>
