<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/x-icon" href="./images/Logo.ico">
<title><?php echo ($title); ?></title>

<!-- CSS Only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<!--<link rel="stylesheet" href="../public/css/style.css" />-->
<link rel="stylesheet" href="../public/css/product.css">
<link rel="stylesheet" href="../public/css/addProduct.css">
<script src="../admin/addProduct.js"></script>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <div class="container-fluid">
      <a class="navbar-brand" style="cursor: pointer;">
        <img id="logo" src="../images/Logo.ico" alt="Lost On The Rack Logo" height="100" width="100" href="../admin/adminPage.php">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Modify
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../admin/addProduct.php">Add Product</a></li>
              <li><a class="dropdown-item" href="../admin/removeProduct.php">Remove Product</a></li>
              <li><a class="dropdown-item" href="../admin/updateProduct.php">Update Product</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Our Staff</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/customer.php">Customers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">LogOut</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>




</header>

</html>