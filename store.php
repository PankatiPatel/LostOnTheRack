<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="./public/css/style.css" />
    <link rel="stylesheet" href="./public/css/product.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="min-vh-100 d-flex flex-column justify-content-between">
    <?php include("./partial/userNavbar.php") ?>


    <div class="alert-container">
        <?php
        if (isset($_SESSION)) {
            if (isset($_SESSION["flash"])) {
                echo '<div class="store-alert alert-${type}">
            <span class="text-white">$_SESSION["flash"]</span>
        </div>';
            }
        }
        ?>
    </div>
    <div class="container">
        <div class="store-heading d-flex flex-column justify-content-center align-items-center">
            <h1>Lost On The Rack</h1>
            <span>Finding Quality Pieces</span>
        </div>


        <?php
        include("./dbconfig.php");

        $con = mysqli_connect($host, $username, $dbpassword, $dbname);

        if (!$con) {
            die("Internal Server Error");
        }

        $sql = "SELECT p.productID, p.productName,p.size, p.price, c.categoryType, i.name FROM Product p, Category c, images i  WHERE p.categoryID = c.categoryID AND p.productID=i.productID GROUP BY p.productName;";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $numOfRows = mysqli_num_rows($result);
            if ($numOfRows > 0) {
                echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4'>";
                while ($row = mysqli_fetch_array($result)) {
                    $filename = $row["name"];
        ?>
                    <div class="col" style="margin: 2.5rem 0;">
                        <div class="card h-100">
                            <img src="./upload/<?php echo $filename; ?>" class="card-img-top" alt="...">
                            <div class="card-body d-flex flex-column h-25">
                                <div class="d-flex justify-content-between align-items-center text-muted">
                                    <span class="card-category"><?php echo $row["categoryType"]; ?></span>
                                    <span><?php echo $row["size"] ? $row["size"] : "One Size"; ?></span>
                                </div>
                                <h5 class="card-title"><?php echo $row["productName"]; ?></h5>

                                <p class="card-text text-muted">$<?php echo $row["price"]; ?>.00</p>
                                <button class="product-btn btn btn-dark mt-auto" data-id=<?php echo $row["productID"]; ?>>
                                    Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
        <?php
                }
                echo " </div>";
            } else {
                echo "
                        <div>
                            <h2 class='text-muted text-center'>No Products Found!</h2>
                            <a href='landing.php'>Home</a>
                        </div>";
            }
        } else {
            echo "
                    <div class='d-flex flex-column align-items-center'>
                        <h2 class='text-muted text-center'>No Products Found!</h2>
                        <a href='landing.php'>Home</a>
                    </div>";
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./public/js/cart.js"></script>
    <script src="./public/js/navbar.js"></script>
</body>

</html>