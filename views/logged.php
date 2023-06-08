<?php
  session_start();
  require_once('../controllers/OrderController.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candy Shop | Strona Główna</title>
    <?php require_once '../style/links.php'; ?>
  </head>
  <body>
    <?php 
      require_once './components/menu.php'; 
      if (isset($_SESSION['success'])) {
        echo "<h5 class='p-4 m-4 bg-primary rounded text-white info-message' id='info'>$_SESSION[success]</h5>";
        unset($_SESSION['success']);
      }  
    ?>
    <div class="container-fluid w-100 bg-dark screen-height d-flex flex-column flex-lg-row justify-content-center text-light menu-buffer">
      <?php
        if (isset($_SESSION['user_id'])) {

          require_once '../db/connect.php';
          if ($_SESSION['user_role'] == 'user') {
            $orders = OrderController::getUserOrders($_SESSION['user_id']);
            echo <<< USERORDERS
            <div class="col col-lg-6 d-flex flex-column p-4 m-2">
              <h3 class="bg-primary bg-gradient p-4 my-4 rounded w-100">Twoje zamówienia</h3>
USERORDERS;
            if(!is_null($orders)) {
              foreach ($orders as $order) {
                $bordercolor = "secondary";
                switch ($order['status_id']) {
                  case 1:
                    $bordercolor = "primary";
                    break;
                  case 2:
                    $bordercolor = "success";
                    break;
                  case 3:
                    $bordercolor = "danger";
                    break;
                  default:
                    break;
                }
                echo "<a href='./order-details.php?number=$order[number]' class='text-reset text-decoration-none fs-5 fw-bolder w-100 p-4 my-2 rounded border border-$bordercolor'>$order[number]</a>";
              }
            } else {
              echo "<h3>Brak zamówień</h3>";
            }
            echo "</div>";
          }
          elseif ($_SESSION['user_role'] == 'employee' || $_SESSION['user_role'] == 'admin') {
            echo <<< NEWORDERS
            <div class="col col-lg-3 d-flex flex-column p-4 m-2">
              <h3 class="bg-primary bg-gradient p-4 my-4 rounded w-100">Nowe zamówienia</h3>
NEWORDERS;
              $orders = OrderController::getOrdersByStatus(1);
              if($orders) {
                foreach ($orders as $order) {
                  echo "<a href='./order-details.php?number=$order[number]' class='text-reset text-decoration-none fs-5 fw-bolder w-100 p-4 my-2 rounded border border-primary'>$order[number]</a>";
                }
              } else {
                echo "<h5>Brak zamówień</h5>";
              }
            echo "</div>";

            echo <<< ACCEPTEDORDERS
            <div class="col col-lg-3 d-flex flex-column p-4 m-2">
              <h3 class="bg-success bg-gradient p-4 my-4 rounded w-100">Zaakceptowane</h3>
ACCEPTEDORDERS;
              $orders = OrderController::getOrdersByStatus(2);
              if($orders) {
                foreach ($orders as $order) {
                  echo "<a href='./order-details.php?number=$order[number]' class='text-reset text-decoration-none fs-5 fw-bolder w-100 p-4 my-2 rounded border border-success'>$order[number]</a>";
                }
              } else {
                echo "<h5>Brak zamówień</h5>";
              }
            echo "</div>";

            echo <<< REJECTEDORDERS
            <div class="col col-lg-3 d-flex flex-column p-4 m-2">
              <h3 class="bg-danger bg-gradient p-4 my-4 rounded w-100">Odrzucone</h3>
REJECTEDORDERS;
              $orders = OrderController::getOrdersByStatus(3);
              if($orders) {
                foreach ($orders as $order) {
                  echo "<a href='./order-details.php?number=$order[number]' class='text-reset text-decoration-none fs-5 fw-bolder w-100 p-4 my-2 rounded border border-danger'>$order[number]</a>";
                }
              } else {
                echo "<h5>Brak zamówień</h5>";
              }
            echo "</div>";
          }
        }
      ?>
    </div>
    <?php require_once('./components/footer.php'); ?>
    <script src="../scripts/displayInfoMessage.js"></script>
  </body>
</html>
