<?php



session_start();


$title = "Customers";
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

$users= "SELECT * FROM Customer"; 
$usersResult= mysqli_query($con, $users); 

$x = 0;
if($usersResult)
{
    while($userRow = mysqli_fetch_array($usersResult))
    {
        $firstName = $userRow["fName"]; 
        $lastName = $userRow["lName"]; 
        $email = $userRow["email"];
        $number = $userRow["phoneNumber"]; 
        $x += 1; 



?>

     
<!DOCTYPE html>
<html>
    <div style = "text-align:center;">
        <table class="table" style = "width: 500px; text-align:center;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Email</th>
            <th scope="col">Number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row"><?php echo $x?></th>
            <td> <?php echo $firstName?> </td>
            <td> <?php echo $lastName?> </td>
            <td> <?php echo $email?> </td>
            <td> <?php echo $number?> </td>
            </tr>

      
        </tbody>
        </table>
    </div>


</html> 

<?php 
    }
}


?>