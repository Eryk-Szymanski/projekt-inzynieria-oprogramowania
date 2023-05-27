<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-shop | Logowanie</title>
  </head>
  <body>
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
    <a href="./">E-shop</a>
    <p>Zaloguj się</p>
    <form action="./scripts/login.php" method="post">
      <label for="email">Email<label>
      <input type="email" id="email">
      <label for="pass">Hasło<label>
      <input type="password" id="pass">
      <button type="submit">Zaloguj</button>
    </form>

    <p>
      <a href="./views/forgot-password.php">Zapomniane hasło</a>
    </p>
    <p>
      <a href="./views/register.php">Zarejestruj się</a>
    </p>
  </body>
</html>
