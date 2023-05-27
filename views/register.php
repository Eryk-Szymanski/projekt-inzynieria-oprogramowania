<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-shop | Rejestracja</title>
  </head>
  <body>
    <p>Rejestracja użytkownika</p>

    <form action="../scripts/register.php" method="post">
      <label for="name">Imię<label>
      <input type="text" id="name">
      <label for="surname">Nazwisko<label>
      <input type="text" id="surname">
      <label for="email">Email<label>
      <input type="email" id="email">
      <label for="email1">Potwierdź Email<label>
      <input type="email" id="email1">
      <label for="phone">Telefon<label>
      <input type="text" id="phone">
      <label for="pass">Hasło<label>
      <input type="password" id="pass">
      <label for="pass1">Potwierdź Hasło<label>
      <input type="password" id="pass1">
      
      <label for="zipcode">Kod pocztowy<label>
      <input type="text" id="zipcode">
      <label for="city">Miasto<label>
      <input type="text" id="city">
      <label for="street">Ulica<label>
      <input type="text" id="street">
      <label for="apartment">Numer mieszkania/domu<label>
      <input type="text" id="apartment">

      <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree">
      <label for="agreeTerms">
        Zatwierdzam <a href="#">regulamin</a>
      </label>
        
      <button type="submit">Zarejestruj</button>
    </form>

    <a href="../">Już mam konto</a>
  </body>
</html>
