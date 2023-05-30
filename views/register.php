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
      <input type="text" id="name" name="name">
      <label for="surname">Nazwisko<label>
      <input type="text" id="surname" name="surname">
      <label for="email">Email<label>
      <input type="email" id="email" name="email">
      <label for="email1">Potwierdź Email<label>
      <input type="email" id="email1" name="email1">
      <label for="phone">Telefon<label>
      <input type="text" id="phone" name="phone">
      <label for="pass">Hasło<label>
      <input type="password" id="pass" name="pass">
      <label for="pass1">Potwierdź Hasło<label>
      <input type="password" id="pass1" name="pass1">
      
      <label for="zipcode">Kod pocztowy<label>
      <input type="text" id="zipcode" name="zipcode">
      <label for="city">Miasto<label>
      <input type="text" id="city" name="city">
      <label for="street">Ulica<label>
      <input type="text" id="street" name="street">
      <label for="apartment">Numer mieszkania/domu<label>
      <input type="text" id="apartment" name="apartment">
        
      <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree">
      <label for="agreeTerms">
        Zatwierdzam <a href="#">regulamin</a>
      </label>
        
      <button type="submit">Zarejestruj</button>
    </form>

    <a href="../">Już mam konto</a>
  </body>
</html>
