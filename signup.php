<?php
if (isset($_COOKIE["userFirstName"]) && isset($_COOKIE["userLastName"]) && isset($_COOKIE["userCustomerID"])) {
    header("Location: landing.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["fname"]) && isset($_POST["lname"])) {
    include "./dbconfig.php";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fName = $_POST["fname"];
    $lName = $_POST["lname"];
    $phoneNumber = $_POST["phoneNumber"];

    $con = mysqli_connect($host, 'patpanka', $dbpassword, $dbname);
    if ($con->connect_error) {
        die("Connection failed" . $con->connect_error);
    }

    $stmt = $con->prepare("INSERT INTO Customer(fName, lName, email, phoneNumber) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $fName, $lName, $email, $phoneNumber);
    $stmt->execute();
    $stmt->close();

    $stmt = $con->prepare("SELECT fName,lName, cid FROM Customer WHERE email= ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $resultNumRows = mysqli_num_rows($result);
    $stmt->close();
    if ($result && $resultNumRows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stmt = $con->prepare("INSERT INTO CustomerCredentials(cid, login, password) VALUES (?,?,?)");
            $stmt->bind_param("iss", $cid, $username, $password);
            $stmt->execute();
            $stmt->close();

            $userFirstName = $credentialRow["fName"];
            $userLastName = $credentialRow["lName"];
            $userCid = $credentialRow["cid"];

            setcookie("userFirstName", $userFirstName, time() + 3600, "/");
            setcookie("userLastName", $userLastName, time() + 3600, "/");
            setcookie("userCustomerID", $userCid,  time() + 3600, "/");

            header("Location: store.php");
        }
    }

    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="./images/Logo.ico" />
    <title>Sign Up - Lost on The Rack</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="./public/css/form.css">
</head>

<body class=" d-flex flex-column justify-content-between">
    <main class="container-fluid">
        <div class="row justify-content-center justify-content-lg-between">
            <section class="auth-content offset-lg-1 offset-xl-1 col col-sm-12 col-md-8 col-lg-5 col-xl-5">
                <div class="img-container w-25 mx-auto">
                    <a href="landing.php">
                        <img class="img-fluid" src="./public/images/Logo.ico" alt="Lost On The Rack Logo">
                    </a>
                </div>
                <h1 class="text-center display-4 mt-2 mb-5">Sign Up</h1>
                <form class="auth-form needs-validation" action="signup.php" method="POST" novalidate>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col"><label for="fname" class="form-label">First name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" autofocus required />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    First name must not be blank!
                                </div>
                            </div>
                            <div class="col"><label for="lname" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" autofocus required />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Last name must not be blank!
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" autofocus required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Phone Number must not be blank!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" autofocus required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Username must not be blank!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Email must not be left blank
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Password must not be blank!
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-success" type="submit">
                            Sign Up!
                        </button>
                    </div>
                    <span class="d-block mt-2">
                        Already have an account?
                        <a class="auth-link text-decoration-none" href="login.php">Login!</a>
                    </span>
                </form>
            </section>
            <section class="sidebar min-vh-100 col-lg-5 col-xl-4 d-none d-lg-flex justify-content-center">
                <a href="landing.php">
                    <img src="./public/images/rack_image.png" alt="Lost On The Rack Logo" class="img-fluid align-self-start">
                </a>
            </section>
        </div>
    </main>
    <script src="./public/js/validation.js"></script>
</body>

</html>