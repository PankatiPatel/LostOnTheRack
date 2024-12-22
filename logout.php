<?php
if (isset($_COOKIE["userFirstName"]) && isset($_COOKIE["userLastName"]) && isset($_COOKIE["userCustomerID"])) {
    setcookie("userFirstName", null, -1, "/");
    setcookie("userLastName", null, -1, "/");
    setcookie("userCustomerID", null,  -1, "/");
    header("Location: landing.php");
}

if (isset($_COOKIE["adminFirstName"]) && isset($_COOKIE["adminLastName"]) && isset($_COOKIE["adminID"])) {
    setcookie("adminFirstName", null, -1, "/");
    setcookie("adminLastName", null, -1, "/");
    setcookie("adminID", null,  -1, "/");
    header("Location: landing.php");
}

header("Location: landing.php");
die();
