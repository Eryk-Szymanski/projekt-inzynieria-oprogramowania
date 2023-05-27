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
      <input type="text">
      <input type="text">
      <input type="email">
      <input type="email">
      <input type="password">
      <input type="password">

      <?php
        require_once '../scripts/connect.php';
        $sql = "SELECT * FROM `cities`";
        $result = $mysqli->query($sql);
        $city = $result->fetch_assoc();
      ?>

      <select>
        <?php
          while ($city = $result->fetch_assoc()) {
            echo "<option value=\"$city[id]\">$city[city]</option>";
          }
        ?>
      </select>

      <input type="date">
      
      <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree">
      <label for="agreeTerms">
        Zatwierdzam <a href="#">regulamin</a>
      </label>
        
      <button type="submit">Zarejestruj</button>
    </form>

    <a href="../">Już mam konto</a>
  </body>
</html>
