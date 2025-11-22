
<?php 

//start session 
session_start();


//create constants to store none repeating values
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));


?>


<?php



 $id= $_GET['id']; // get id for deletation 

$sql="DELETE FROM tbl_admin WHERE id= $id"; //querry for dlt admin 

//execution 
$res=mysqli_query($conn, $sql);


if($res==true){
   // echo "deleted";
   $_SESSION['delete']= "admin deleted succesfully";//session variable to display msges 
   header("location: " . SITEURL . "admin/manage-admin.php");

}
else {
    //echo "failed";
    $_SESSION['delete']= 'try again ';
     header("location: " . SITEURL . "admin/manage-admin.php");
     exit();
}


?>
