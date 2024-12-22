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

$id = $_SESSION["ID"];

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
                        

     $updateRow = "UPDATE 2021F_patpanka.Product
                   SET  productName = '$productName', 
                        productCompany = '$productCompany',
                        categoryID = $productCategory,
                        size = '$productSize', 
                        price = $productPrice, 
                        totalQuantity = $productQuantity 
                 WHERE productID = $id"; 

        mysqli_query($con,$updateRow) or die ("could not update");                              
    

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
           $query = "UPDATE 2021F_patpanka.images 
                     SET name = '".$name."'
                     WHERE productID = $id"; 
           mysqli_query($con,$query);
        }
   
     }

}

$_SESSION["message"] = "Record has been updated";
$_SESSION["msg_type"] = "danger";
header("location:updateProduct.php");





?> 