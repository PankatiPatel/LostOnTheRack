<?php
session_start();

$title = "Update Product";
include ("../partial/navbar.php"); // this is the admin navbar 

if(!isset($_COOKIE['adminID']))
	header("location: ../login.html");


include "../dbconfig.php";

// default time zone set to NY
date_default_timezone_set('America/New_York');

// connection to the db 
$con = mysqli_connect($host,$username,$dbpassword,$dbname)
or die ("<br> Cannot connect to DB: $dbname on $host " .mysqli_connect_error());



$productName = "";
$productCompany ="";
$productCategory = "";
$productSize = "";
$productPrice = "";
$productQuantity = "";


if(isset($_GET['remove'])){
     $id = $_GET['remove'];

     $_SESSION["message"] = "Record has been deleted";
     $_SESSION["msg_type"] = "danger";

     $deleteProduct = "DELETE FROM 2021F_patpanka.Product where productID = $id";
     $deleteImage = "DELETE FROM 2021F_patpanka.images where productID = $id";
        mysqli_query($con,$deleteProduct) or die($mysqli->error());
        mysqli_query($con,$deleteImage);
        header('location: removeProduct.php');
   
 }



if(isset($_GET['update'])){
$id = $_GET['update'];
$update = "true";
$_SESSION["ID"] = $id; 



$getCategory = "SELECT * FROM 2021F_patpanka.Category";
$updateProduct = "SELECT  p.productName, p.productCompany,p.size,p.price,p.totalQuantity,c.categoryType, c.categoryID, i.name 
                 from 2021F_patpanka.Category c, 2021F_patpanka.Product p, 2021F_patpanka.images i 
                 where c.categoryID = p.categoryID and p.productID = i.productID and  p.productID = $id";

$resultUpdate = mysqli_query($con,$updateProduct);
$categoryResult= mysqli_query($con, $getCategory); 
$categoryRow = mysqli_num_rows($categoryResult);



if($resultUpdate){

     while($updateRow = mysqli_fetch_array($resultUpdate))   
     { 
               $productName = $updateRow["productName"];
               $productCompany = $updateRow["productCompany"];
               $productSize = $updateRow["size"];
               $productPrice = $updateRow["price"];
               $productQuantity = $updateRow["totalQuantity"];  
               $productCategory = $updateRow["categoryType"]; 
               $productCategoryID = $updateRow["categoryID"]; 
               $productImage = $updateRow["name"];
     }

    
}
else 
     echo "item not found"; 


     
?>


<!DOCTYPE html>
<html>

    <div id="form">
         <form action="update.php" method="POST" enctype="multipart/form-data">
            <div class="form-group" id = "form" >
                <label for="productName">Product Name: </label>
                    <input type="text" class = "input" name= "productName" id="productName" value = "<?php echo $productName?>"  required="required" style = "width: 300px;"> <br>

 
                <label for="productCompany">Product Company: </label>
                    <input type="text"  class = "input" name= "productCompany" id = "productCompany" value = "<?php echo $productCompany?>"  required="required" style = "width: 300px;"> <br>

  
                <label for="productCategory">Category: </label>
                    <select class="selectpicker"  class = "input" id = "productCategory"   name="productCategory" required="required" >
                        <option value = "<?php echo $productCategoryID ?> "> <?php echo $productCategory?> </option>

                            <?php
                                if($categoryResult > 0)
                                {

                                    while($categoryData = mysqli_fetch_array($categoryResult))
                                    {
                                        echo '<option value = "'.$categoryData["categoryID"]. '">'.$categoryData["categoryType"].'</option>';
                        
                                    }
                                 }
                
                                    mysqli_free_result($categoryResult);
                            ?>
                    </select> 

    

                <label for="productSize "> Size: </label> 
                    <select class="selectpicker"  class = "input" id = "size" class = "size" name="size" required="required" >
                         <option> <?php echo $productSize ?></option>
                    </select><br>
                    
                   
                <label for="productQuantity "> Quantity: </label> 
                    <input type = "number"  class = "input" min = 1  value = "<?php echo $productQuantity?>" name = "productQuantity" id = "productQuantity" required = "required"><br>
              
                <label for="productPrice"> Price: </label>
                    <span>$</span>
                    <input type = "number" class = "input"  name = "productPrice"  value = "<?php echo $productPrice?>" id = "productPrice" min = 1 aria-label= "Amount (to the nearest dollar)" required="required">
                    <span >.00</span> <br
                    >
         <!--   <div id = "productImages">
                <label for="exampleFormControlFile1">Image 1: </label><span>
                    <input type="file" name = "" class = "imageButton" id="image1" requiered = "requiered"></span> <br>

                <label for="exampleFormControlFile1">Image 2: </label><span>
                    <input type="file"  class = "imageButton" id="image1"></span> <br>
                    
                <label for="exampleFormControlFile1">Image 3: </label>
                    <input type="file"  class = "imageButton" id="image2"> <br>

                <label for="exampleFormControlFile1">Image 4: </label>
                    <input type="file"  class = "imageButton" id="image3"> <br>
                
                <label for="exampleFormControlFile1">Image 5: </label>
                    <input type="file"  class = "imageButton" id="image4"> <br>
          -->   

          <input type = "file"  class = "input"  id = "imageButton" name = "file"  > <br>
                <img src="../upload/<?php echo $productImage; ?>"  alt="..." style = "width 100px; height: 150px;">


            </div>
                <input class = "button" name = "submit" value = "Update Product" type="submit">

  

    
       </div>
        </form>
 </div>
</form>

</html>

<?php

     



}
    
     

?>
 