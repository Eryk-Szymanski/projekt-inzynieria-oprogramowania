<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Zapomnianie hasło</title>
    <?php
      require_once '../style/links.php';
    ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center">
      <div class="col col-lg-3 bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center w-25">
        
        <img src="../images/logo.png" class="image-medium"/>
        <h1><a href="./" class="text-decoration-none fw-bolder">Candy Shop</a></h1>
        <h3 class="px-4 py-2">Zapomniane hasło? Tutaj możesz łatwo otrzymać nowe hasło.</h3>
        
        <form action="recover-password.html" method="post" class="d-flex flex-column p-2 border-top border-white">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email">
          <button type="submit" class="btn btn-primary my-4 w-100">Stwórz nowe hasło</button>
        </form>
        
        <a href="../" class="m-2 text-reset fs-5">Logowanie</a>
      
      </div>
    </div>
  </body>
</html>
