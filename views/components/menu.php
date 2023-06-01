<div class="fixed-top bg-warning d-flex align-items-center">
    
    <a href="./logged.php" class="d-flex align-items-center text-decoration-none fw-bolder">
        <img src="../images/logo.png" class="image-small"/>
        <h1>Candy Shop</h1>
    </a>

    <a href="./products.php" class="btn btn-primary m-4">Produkty</a>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-auto d-flex flex-row align-items-center m-0 p-0">
            
                <?php
                    echo "<h3 class='m-4'>$_SESSION[user_name]</h3>";
                    if(isset($_SESSION['cart'])) {
                        echo "<h3 class='text-light my-4 mx-1'>" . count($_SESSION['cart']) . "</h3>";
                    }
                ?>
                <a href="./new-order.php"><i class="bi bi-basket3 fs-2 text-light"></i></a>
                
                <form action="../scripts/logout.php" method="post">
                    <button type="submit" class="btn btn-primary m-4">Wyloguj</button>
                </form>

            </div>
        </div>
    </div>

</div>
