<?php
  session_start();
  require_once('../controllers/AccountController.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Użytkownicy</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <?php require_once './components/menu.php'; ?>
    <div class="container-fluid w-100 bg-dark screen-height d-flex flex-column flex-lg-row justify-content-center text-light menu-buffer">
        <?php
            if (isset($_SESSION['success'])) {
            echo <<< USERS
            <div class="col col-lg-6 d-flex flex-column p-4 m-4">
                <h3 class="bg-primary bg-gradient p-4 my-4 rounded w-100">Użytkownicy</h3>
                <table>
                <tr>
                    <th>Id</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Rola</th>
                </tr>
USERS;
            $users = AccountController::getUsers();
            foreach ($users as $user) {
                echo <<< USERSADMIN
                <tr>
                <td>$user[id]</td>
                <td>$user[name]</td>
                <td>$user[surname]</td>
                <td>$user[role]</td>
                </tr>
USERSADMIN;
            }
            echo "</table></div>";
            }
        ?>
    </div>
    <?php require_once('./components/footer.php'); ?>
  </body>
</html>
