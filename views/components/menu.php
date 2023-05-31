<div class="fixed-top bg-warning d-flex flex-row align-items-center">
    
    <a href="./logged.php" class="d-flex align-items-center text-decoration-none fw-bolder">
        <img src="../images/logo.png" style="height:75px;"/>
        <h1>Candy Shop</h1>
    </a>
    
    <?php
        echo "<h3 class='m-4'>$_SESSION[user_name]</h3>";
    ?>

    <a href="./products.php" class="btn btn-primary m-4">Produkty</a>

    <?php
        if(isset($_SESSION['cart'])) {
            echo count($_SESSION['cart']);
        }
    ?>
    <a href="./new-order.php"><i class="bi bi-basket3 fs-2 text-light"></i></a>
    
    <form action="../scripts/logout.php" method="post" class="float-end">
        <button type="submit" class="btn btn-primary m-4">Wyloguj</button>
    </form>

</div>
