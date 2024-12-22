
<?php



session_start();


$title = "Add Product";
include ("../partial/navbar.php"); // this is the admin navbar 


// check cookie if not set have user login again 
if(!isset($_COOKIE['adminID']))
	header("location: ../login.html");


include "../dbconfig.php";

// default time zone set to NY
date_default_timezone_set('America/New_York');

// connection to the db 
$con = mysqli_connect($host,$username,$dbpassword,$dbname)
or die ("<br> Cannot connect to DB: $dbname on $host " .mysqli_connect_error());



// getting the data that is in the prouct category table to populate a drop down menu
$getCategory = "SELECT * FROM 2021F_patpanka.Category";
$categoryResult= mysqli_query($con, $getCategory); 
$categoryRow = mysqli_num_rows($categoryResult);

     echo "<br>";

     
?>
     
<!DOCTYPE html>
<html>

    <div id="form">
         <form action="insertProduct.php" method="POST" enctype="multipart/form-data">
            <div class="form-group" id = "form" >
                  <?php if(isset($_SESSION["message"]))
                         echo $_SESSION['message'];
                          unset($_SESSION['message']);
                      ?>
   
               <br> <label for="productName">Product Name: </label>
                    <input type="text" class = "input" name= "productName" id="productName" placeholder="Product Name"  required="required" style = "width: 300px;"> <br>

 
                <label for="productCompany">Product Company: </label>
                    <input type="text"  class = "input" name= "productCompany" id = "productCompany" placeholder="Product Company"  required="required" style = "width: 300px;"> <br>

  
                <label for="productCategory">Category: </label>
                    <select class="selectpicker"  class = "input" id = "productCategory" name="productCategory" required="required" >
                        <option> </option>

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
                    <select class="selectpicker"  class = "input" id = "size" class = "size" name="size" required="required" ></select><br>
                   
                <label for="productQuantity "> Quantity: </label> 
                    <input type = "number"  class = "input" min = 1 name = "productQuantity" id = "productQuantity" required = "required"><br>
              
                <label for="productPrice"> Price: </label>
                    <span>$</span>
                    <input type = "number" class = "input"  name = "productPrice" id = "productPrice" min = 1 aria-label= "Amount (to the nearest dollar)" required="required">
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

          <input type = "file"  class = "input" id = "imageButton" name = "file" >


            </div>
                <input class = "button" name = "submit" value = "Add Product" type="submit"> 

  

    
       </div>
        </form>
 </div>
</form>

</html>


