<?php 

// Start session 
session_start();

// Create constants
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

// LOGIN CHECK (FIXED)
if(!isset($_SESSION['user'])) 
{
    $_SESSION['no-login-msg']= "<div class='error'>Please login to access admin panel.</div>";
    header('location:' . SITEURL . 'admin/login.php');
    exit();
}

// Handle form submission
if(isset($_POST['submit'])) 
{
    // Get form values
    $title = $_POST['tittle']; // your column = tittle
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "no";
    $active = isset($_POST['active']) ? $_POST['active'] : "no";

    // Insert query (FIXED COLUMN NAME)
    $sql = "INSERT INTO tbl_category SET
        tittle='$title',
        featured='$featured',
        active='$active'";

    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
        header("location:" . SITEURL . "admin/manage-category.php");
        exit();
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
        header("location:" . SITEURL . "admin/add-category.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Restaurant Website</title>
</head>
<body>
 
<div class="menu">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1><br>

        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <br><br>

        <!-- Form -->
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="tittle" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<div class="footer">
    <div class="wrapper">
        <p class="text-center">© 2025 All rights reserved, Web Restaurant. Developed by Tansin Tabassum</p>
    </div>
</div>

</body>
</html>

<style>

.wrapper { width: 80%; margin: 0 auto; }

.menu, .main-content, .footer { padding: 20px; background-color: #fff; }
.menu { text-align: center; border-bottom: 1px solid black; }
.menu ul { list-style-type: none; }
.menu ul li { display: inline; padding: 1%; }
.menu ul li a { text-decoration: none; font-weight: bold; color: #ff6b81; }
.menu ul li a:hover { color: #57606f; }

.main-content { background-color: #dfe4ea; padding: 3% 0; }

.tbl-30 { width: 30%; }
table tr td { padding: 1%; }

.btn-secondary {
    background-color: #6ab04c;
    padding: 1%;
    color: white;
    text-decoration: none;
    font-weight: bold;
}
.btn-secondary:hover { background-color: #badc58; }

.footer { text-align: center; font-size: 14px; color: #fff; background-color: #57606f; }

</style>
