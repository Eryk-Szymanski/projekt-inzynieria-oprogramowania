<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Strona Główna</title>
    <?php
      require_once '../style/links.php';
    ?>
  </head>
  <body>
    <div class="container-fluid w-100 bg-dark screen-height d-flex justify-content-center align-items-center text-light">
      <?php
        if (isset($_SESSION['success'])) {

          require_once './components/menu.php';

          require_once '../scripts/connect.php';
          if ($_SESSION['user_role'] == 'user') {
            $sql = "SELECT orders.number FROM `orders` WHERE `user_id` = $_SESSION[user_id]";
            $result = $mysqli->query($sql);
            echo <<< USERORDERS
            <div class="d-flex flex-column bg-success bg-gradient p-4 m-4 rounded">
              <h3>Twoje zamówienia</h3>
              <ul class='list-group'>
USERORDERS;
            $orders = $result->fetch_assoc();
            if(!is_null($orders)) {
              foreach ($orders as $order) {
                echo "<li class='list-group-item'><a href='./order-details.php?number=$order[number]'>$order[number]</a></li>";
              }
            } else {
              echo "<h3>Brak zamówień</h3>";
            }
            echo "</ul></div>";
          }
          elseif ($_SESSION['user_role'] == 'employee') {
            $sql = "SELECT orders.number FROM `orders` WHERE `status` = 0";
            $result = $mysqli->query($sql);
            echo <<< NEWORDERS
            <div class="d-flex flex-column bg-success bg-gradient p-4 m-4 rounded">
              <h3>Nowe zamówienia</h3>
              <ul class='list-group'>
NEWORDERS;
              while ($order = $result->fetch_assoc()) {
                echo "<li class='list-group-item'><a href='./order-details.php?number=$order[number]'>$order[number]</a></li>";
              }
            echo "</ul></div>";

            $sql = "SELECT orders.number FROM `orders` WHERE `status` = 1";
            $result = $mysqli->query($sql);  
            echo <<< ACCEPTEDORDERS
            <div class="d-flex flex-column bg-success bg-gradient p-4 m-4 rounded">
              <h3>Zaakceptowane</h3>
              <ul class='list-group'>
ACCEPTEDORDERS;
            while ($order = $result->fetch_assoc()) {
              echo "<li class='list-group-item'><a href='./order-details.php?number=$order[number]'>$order[number]</a></li>";
            }
            echo "</ul></div>";

            $sql = "SELECT orders.number FROM `orders` WHERE `status` = 2";
            $result = $mysqli->query($sql);  
            echo <<< REJECTEDORDERS
            <div class="d-flex flex-column bg-success bg-gradient p-4 m-4 rounded">
              <h3>Odrzucone</h3>
              <ul class='list-group'>
REJECTEDORDERS;
            while ($order = $result->fetch_assoc()) {
              echo "<li class='list-group-item'><a href='./order-details.php?number=$order[number]'>$order[number]</a></li>";
            }
            echo "</ul></div>";
          }
          elseif ($_SESSION['user_role'] == 'admin') {
            $sql = "SELECT users.id, users.name, users.surname, roles.role FROM `users` JOIN `roles` ON users.role_id = roles.id";
            $result = $mysqli->query($sql);
            echo <<< USERS
            <div class="d-flex flex-column bg-success bg-gradient p-4 m-4 rounded">
              <h3>Użytkownicy</h3>
              <table>
                <tr>
                  <th>Id</th>
                  <th>Imię</th>
                  <th>Nazwisko</th>
                  <th>Rola</th>
                </tr>
USERS;
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
    </div>
  </body>
</html>
