<?php

session_start();

// check cookie if not set have user login again 
if(!isset($_COOKIE['adminID']))
	header("location: ../login.html");


include "../dbconfig.php";

// default time zone set to NY
date_default_timezone_set('America/New_York');

// connection to the db 
$con = mysqli_connect($host,$username,$dbpassword,$dbname)
or die ("<br> Inernal Servers are down right now");



// getting the data that is in the prouct category table to populate a drop down menu
$getCategory = "SELECT * FROM 2021F_patpanka.Category";
$categoryResult= mysqli_query($con, $getCategory); 
$categoryRow = mysqli_num_rows($categoryResult);

$product = "SELECT * FROM 2021F_patpanka.Product"; 
$productResult= mysqli_query($con, $product);
$productNum = mysqli_num_rows($productResult);
$productRow = mysqli_fetch_array($productResult);





if(isset($_POST["productName"]))
    $productName = $_POST["productName"];
   


if(isset($_POST["productCompany"]))
    $productCompany = $_POST["productCompany"];




if(isset($_POST["productCategory"]))
    $productCategory = $_POST["productCategory"];




if(isset($_POST["size"]))
    $productSize = $_POST["size"];



if(isset($_POST["productQuantity"]))
    $productQuantity = $_POST["productQuantity"];



if(isset($_POST["productPrice"]))
    $productPrice = $_POST["productPrice"];


    


            $insertProduct = "INSERT INTO 2021F_patpanka.Product (productName,productCompany,categoryID,size,price,totalQuantity) 
                                                 Values ('$productName','$productCompany',$productCategory, '$productSize',$productPrice,$productQuantity)";

                    mysqli_query($con,$insertProduct) or die("Internal Servers are down right now"); 
                

                    $productID = "SELECT productID FROM 2021F_patpanka.Product where productName = '$productName'" ;
                    $productIDResult= mysqli_query($con, $productID);
                    $productIDNum = mysqli_num_rows($productIDResult);
                    $productIDRow = mysqli_fetch_array($productIDResult);
                
                    $ID = $productIDRow["productID"];
                    
                    if(isset($_POST['submit'])){
 
                        $name = $_FILES['file']['name'];
                        $target_dir = "../upload/";
                        $target_file = $target_dir . basename($_FILES["file"]["name"]);
                    
                     
                      
                        // Select file type
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                      
                        // Valid file extensions
                        $extensions_arr = array("jpg","jpeg","png","gif");
                      
                        // Check extension
                        if( in_array($imageFileType,$extensions_arr) ){
                           // Upload file
                           if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
                              // Insert record
                              $query = "insert into 2021F_patpanka.images(name,productID) values('".$name."', $ID)";
                              if(mysqli_query($con,$query))
                              {
                                $_SESSION["message"] = "Product added"; 
                                header("location: addProduct.php");
                    
                      
                              }
                           }
                      
                        }
                       
                      }
                    
            
                


?>