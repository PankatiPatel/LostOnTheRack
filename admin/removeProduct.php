<?php 

session_start();

$title = "Remove Product";
include ("../partial/navbar.php"); // this is the admin navbar 

if(!isset($_COOKIE['adminID']))
	header("location: ../login.html");


include "../dbconfig.php";

// default time zone set to NY
date_default_timezone_set('America/New_York');

// connection to the db 
$con = mysqli_connect($host,$username,$dbpassword,$dbname)
or die ("<br> Cannot connect to DB: $dbname on $host " .mysqli_connect_error());



 echo "<br>";

 if(isset($_SESSION["message"]))
 {
?>
    <div class = "alert alert-<?$_SESSION['msg_type']?>"role = "alert">
    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php } ?>



 <?php
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
                     <img src="../upload/<?php echo $filename; ?>" class="card-img-top" alt="...">
                     <div class="card-body d-flex flex-column h-25">
                         <div class="d-flex justify-content-between align-items-center text-muted">
                             <span class="card-category"><?php echo $row["categoryType"]; ?></span>
                             <span><?php echo $row["size"] ? $row["size"] : "One Size"; ?></span>
                         </div> 
                          <h5 class="card-title"><?php echo $row["productName"]; ?></h5>
                         <p class="card-text text-muted">$<?php echo $row["price"]; ?>.00</p>
                         <a href = "delete.php?remove= <?php echo $row["productID"];?>"
                            class = "product-btn btn btn-dark mt-auto" style = 'background-color:red; '>Remove Item</a>
                            
                        
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