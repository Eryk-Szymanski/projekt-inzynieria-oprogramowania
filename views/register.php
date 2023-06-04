<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Rejestracja</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center">
      <div class="mh-200 col col-lg-6 bg-warning bg-gradient rounded d-flex flex-column justify-content-center align-items-center">

        <img src="../images/logo.png" class="image-medium"/>
        <h1><a href="./" class="text-decoration-none fw-bolder">Candy Shop</a></h1>
        <h3 class="p-2">Rejestracja użytkownika</h3>

        <form action="../controllers/AccountController/register.php" method="post" class="d-flex flex-column flex-lg-row">
          <div class="d-flex flex-column p-4 border-top border-white">
            <h5>Twoje dane</h5>
            <label for="name">Imię</label>
            <input type="text" class="form-control" id="name" name="name">
            <label for="surname">Nazwisko</label>
            <input type="text" class="form-control" id="surname" name="surname">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <label for="email1">Potwierdź Email</label>
            <input type="email" class="form-control" id="email1" name="email1">
            <label for="phone">Telefon</label>
            <input type="text" class="form-control" id="phone" name="phone">
            <label for="pass">Hasło</label>
            <input type="password" class="form-control" id="pass" name="pass">
            <label for="pass1">Potwierdź Hasło</label>
            <input type="password" class="form-control" id="pass1" name="pass1">
          </div>
          
          <div class="d-flex flex-column p-4 border-top border-white">
            <h5>Adres</h5>
            <label for="zipcode">Kod pocztowy</label>
            <input type="text" class="form-control" id="zipcode" name="zipcode">
            <label for="city">Miasto</label>
            <input type="text" class="form-control" id="city" name="city">
            <label for="street">Ulica</label>
            <input type="text" class="form-control" id="street" name="street">
            <label for="apartment">Budynek/mieszkanie</label>
            <input type="text" class="form-control" id="apartment" name="apartment">
          </div>
          
          <div class="d-flex flex-column p-4 border-top border-white">
            <h5>Zgody</h5>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="checkbox" class="btn-check" id="agreeTerms" name="agreeTerms" autocomplete="off" value="agree">
                <label class="btn btn-outline-primary" for="agreeTerms">
                  Zatwierdzam <a href="#" class="text-reset text-decoration-none fw-bolder">regulamin</a>
                </label>
            </div>
            <button type="submit" class="btn btn-primary my-4 w-100">Zarejestruj</button>
          </div>

        </form>

        <a href="../" class="m-2 text-reset fs-5">Już mam konto</a>
      
      </div>
    </div>
  </body>
</html>
