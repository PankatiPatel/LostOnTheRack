<?php
session_start();
?>
<!-- maybe the navbar should be fixed-top because adding the background color make the page look bad when the usr scrolls. idk -->
<nav class="navbar navbar-light navbar-expand-lg fixed-top">
    <div class="container-fluid align-items-lg-end">
        <div class="img-container w-25">
            <a class="navbar-brand" href="landing.php"><img class="img-fluid" src="./public/images/Logo.ico" alt="..."></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="landing.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="store.php">STORE</a>
                </li>
                <?php
                if (isset($_COOKIE["userFirstName"]) && isset($_COOKIE["userLastName"]) && isset($_COOKIE["userCustomerID"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">LOGOUT</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.html">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">SIGN UP</a>
                    </li>
                <?php } ?>
                <li class="nav-item cart">
                    <a href="checkout.php" class="nav-link cart-btn border-0 bg-transparent"><i class="fas fa-shopping-cart"></i>
                        <div class="cart-count bg-dark d-flex justify-content-center ">
                            <span class="text-light cart-count-display">
                                <?php
                                if (isset($_SESSION) && isset($_SESSION["cart"])) {
                                    echo count($_SESSION["cart"]);
                                } else {
                                    echo "0";
                                }
                                ?>
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>