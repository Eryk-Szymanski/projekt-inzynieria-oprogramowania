<nav class="navbar navbar-expand-lg bg-warning fixed-top text-dark p-0 m-0">
    
    <a href="./logged.php" class="d-flex align-items-center text-decoration-none fw-bolder mx-2">
        <img src="../images/logo.png" class="image-small"/>
        <h3>Candy Shop</h3>
    </a>

    <button class="navbar-toggler mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
        <div class="w-100 d-flex flex-column flex-lg-row justify-content-center align-items-center">
        <a href="./logged.php" class="col-11 col-lg-auto btn btn-primary m-2 my-lg-0 px-4">Zamówienia</a>
        <a href="./products.php" class="col-11 col-lg-auto btn btn-primary m-2 my-lg-0 px-4">Produkty</a>

        <?php if ($_SESSION['user_role'] == 'employee')
            echo "<a href='./add-product.php' class='col-11 col-lg-auto btn btn-primary m-2 my-lg-0 px-4'>Dodaj produkt</a>"; ?>

        <?php if ($_SESSION['user_role'] == 'employee' || $_SESSION['user_role'] == 'admin')
            echo "<a href='./users.php' class='col-11 col-lg-auto btn btn-primary m-2 my-lg-0 px-4'>Użytkownicy</a>"; ?>

        <div class="col">
            <div class="justify-content-end d-flex flex-row align-items-center flex-wrap p-4 p-lg-0">
            
                <?php
                    echo "<h3 class='m-4'>$_SESSION[user_name]</h3>";
                    if(isset($_SESSION['cart'])) {
                        echo "<h3 class='text-light my-4 my-lg-0 mx-1'>" . count($_SESSION['cart']) . "</h3>";
                    }
                ?>
                <a href="./new-order.php"><i class="bi bi-basket3 fs-2 text-light"></i></a>
                
                <form action="../scripts/handleForm.php" method="post">
                    <button type="submit" class="mx-4 px-4 btn btn-danger" name="logout">Wyloguj</button>
                </form>
            </div>
        </div>
        </div>
    </div>

</nav>
