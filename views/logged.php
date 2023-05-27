<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-shop | Strona Główna</title>
  </head>
  <body>
    <?php
      require_once './components/menu.php';

      if (isset($_SESSION['success'])) {
        echo <<< LOGOUT
        <form action="../scripts/logout.php" method="post">
            <button type="submit">Wyloguj</button>
        </form>
LOGOUT;
        echo "<p>Witaj $_SESSION[user_name]</p>";
        require_once '../scripts/connect.php';
        if ($_SESSION['user_role'] == 'user') {
          $sql = "SELECT orders.number FROM `orders` WHERE `user_id` = $_SESSION[user_id]";
          $result = $mysqli->query($sql);
          echo <<< USER
          <h5><a href="./products.php">Wszystkie produkty</a></h5>
          <h3>twoje zamówienia</h3>
USER;
          while ($order = $result->fetch_assoc()) {
            echo "<a href='./order-details.php?number=$order[number]'>$order[number]</a><br>";
          }
        }
        elseif ($_SESSION['user_role'] == 'superuser') {
          $sql = "SELECT orders.number FROM `orders` WHERE `status` = 0";
          $result = $mysqli->query($sql);
          echo <<< SUPERUSER
          <h5><a href="./products.php">Wszystkie produkty</a></h5>
          <h3>Nowe zamówienia -> Do zaakceptowania</h3>
SUPERUSER;

          while ($order = $result->fetch_assoc()) {
            echo "<a href='./order-details.php?number=$order[number]'>$order[number]</a><br>";
          }

          $sql = "SELECT orders.number FROM `orders` WHERE `status` = 1";
          $result = $mysqli->query($sql);  
          echo "<h3>Historia zamówień -> Zaakceptowane</h3>";
          while ($order = $result->fetch_assoc()) {
            echo "<a href='./order-details.php?number=$order[number]'>$order[number]</a><br>";
          }

          $sql = "SELECT orders.number FROM `orders` WHERE `status` = 2";
          $result = $mysqli->query($sql);  
          echo "<h3>Historia zamówień -> Odrzucone</h3>";
          while ($order = $result->fetch_assoc()) {
            echo "<a href='./order-details.php?number=$order[number]'>$order[number]</a><br>";
          }
        }
        elseif ($_SESSION['user_role'] == 'admin') {
          $sql = "SELECT users.id, users.name, users.surname, roles.role FROM `users` JOIN `roles` ON users.role_id = roles.id";
          $result = $mysqli->query($sql);
          echo <<< ADMIN
          <h5><a href="./products.php">Wszystkie produkty</a></h5>
          <h3>Uzytkownicy</h3>
          <table>
            <tr>
              <th>Id</th>
              <th>Imię</th>
              <th>Nazwisko</th>
              <th>Rola</th>
            </tr>
ADMIN;
          while ($user = $result->fetch_assoc()) {
            echo <<< USERSADMIN
            <tr>
              <td>$user[id]</td>
              <td>$user[name]</td>
              <td>$user[surname]</td>
              <td>$user[role]</td>
            </tr>
USERSADMIN;
          }
          echo "</table>";
        }
      }
    ?>
  </body>
</html>
