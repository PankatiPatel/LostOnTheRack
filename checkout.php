<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // // Unset all of the session variables.
    $_SESSION["cart"] = array();
    // // If it's desired to kill the session, also delete the session cookie.
    // // Note: This will destroy the session, and not just the session data!
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    $_SESSION["flash"] = "Purchase Completed!";
    header("Location: store.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Lost On The Rack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="./public/css/style.css" />
    <link rel="stylesheet" href="./public/css/product.css">
    <link rel="stylesheet" href="./public/css/checkout.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include("./partial/userNavbar.php"); ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <?php
                    // if (!$_SESSION) session_start();
                    if (isset($_SESSION["cart"])) {
                        $count = count($_SESSION["cart"]);
                    ?>
                        <span class="bg-secondary text-light badge badge-secondary badge-pill">
                            <?php echo $count; ?>
                        </span>
                    <?php
                    } else {
                    ?>
                        <span class="bg-secondary text-light badge badge-secondary badge-pill">
                            0
                        </span>
                    <?php
                    }
                    ?>

                </h4>
                <ul class="list-group mb-3">
                    <?php
                    if (isset($_SESSION["cart"])) {
                        include("./dbconfig.php");
                        $total = 0;
                        if (!function_exists("array_column")) {

                            function array_column($array, $column_name)
                            {

                                return array_map(function ($element) use ($column_name) {
                                    return $element[$column_name];
                                }, $array);
                            }
                        }
                        $itemIdArray = array_column($_SESSION["cart"], "itemId");


                        $con = mysqli_connect($host, $username, $dbpassword, $dbname);
                        if ($con->connect_error) {
                            die("Internal Server Error" . $con->connect_error);
                        }

                        $sql = "SELECT p.productID, p.productName, c.categoryType, p.size, p.price FROM Product p, Category c WHERE p.categoryID=c.categoryID";
                        $result = mysqli_query($con, $sql);
                        $numOfRows = mysqli_num_rows($result);
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {

                                foreach ($itemIdArray as $id) {
                                    if ($row["productID"] == $id["itemId"]) {
                                        $total = $total + $row["price"];

                    ?>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0"><?php echo $row["productName"] ?></h6>
                                                <small class="text-muted"><?php echo $row["categoryType"] ?></small>
                                                <small class="text-muted"><?php echo $row["size"] ?></small>
                                            </div>
                                            <span class="text-muted">$<?php echo $row["price"] ?></span>
                                        </li>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>$<?php echo $total ?></strong>
                            </li>
                        <?php
                        } else {
                            echo "
                            <div>
                                <h2 class='text-muted text-center'>Internal Server Error!</h2>
                                <a href='landing.php'>Home</a>
                            </div>";
                        }
                    } else {
                        // FIX THIS
                        ?>
                        <li class="list-group-item">
                            <div class="text-center">
                                <h6 class="my-3 text-muted">Cart is empty</h6>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>No items in your Cart</strong>
                        </li>
                    <?php
                    }

                    ?>
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate="" method="POST" action="checkout.php">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username" required="">
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required="">
                                <option value="">Choose...</option>
                                <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" required="">
                                <option value="">Choose...</option>
                                <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required="">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block checkout-btn" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./public/js/validation.js"></script>
</body>

</html>