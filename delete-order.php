<?php
session_start();

define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Connect to DB
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided
if(isset($_GET['id'])){
    $id = intval($_GET['id']); // sanitize input

    // Delete the order
    $sql = "DELETE FROM tbl_order WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['delete'] = "<div class='success'>Order deleted successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete order.</div>";
    }

    header("location: manage-order.php");
    exit();
} else {
    header("location: manage-order.php");
    exit();
}
?>
