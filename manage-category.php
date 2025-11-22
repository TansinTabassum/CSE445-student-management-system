<?php 

session_start();

define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());
mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

/* ---------------------------------------------------------
   DELETE CATEGORY (Built Inside This Page)
---------------------------------------------------------- */
if(isset($_GET['delete_id'])){

    $delete_id = $_GET['delete_id'];

    // Delete query
    $sql_delete = "DELETE FROM tbl_category WHERE id=$delete_id";
    $res_delete = mysqli_query($conn, $sql_delete);

    if($res_delete){
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
    }

    // Redirect to refresh the page
    header("location:" . SITEURL . "admin/manage-category.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Category</title>
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
        
        <h1>Manage Category</h1>

        <!-- Messages -->
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
            // Fetch categories
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);

            if($res){
                $count = mysqli_num_rows($res);
                $sn = 1;

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $tittle = $row['tittle'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td><?php echo $sn++ . "."; ?></td>
                            <td><?php echo $tittle; ?></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update Category</a>

                                <!-- Delete inside the same file -->
                                <a href="manage-category.php?delete_id=<?php echo $id; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this category?');"
                                   class="btn-danger">
                                   Delete Category
                                </a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='error'>No categories added yet.</td></tr>";
                }
            }
            ?>

        </table>

    </div>
</div>

<div class="footer">
    <div class="wrapper">
        <p class="text-center">© 2025 All rights reserved. Developed by Tansin Tabassum.</p>
    </div>
</div>

</body>
</html>

<style>
/* Your CSS */
.wrapper { width: 80%; margin: 0 auto; }
.menu, .main-content, .footer { padding: 20px; background-color: #fff; }
.menu { text-align: center; border-bottom: 1px solid black; }
.menu ul { list-style-type: none; }
.menu ul li { display: inline; padding: 1%; }
.menu ul li a { text-decoration: none; font-weight: bold; color: #ff6b81; }
.menu ul li a:hover { color: #57606f; }
.main-content { background-color: #dfe4ea; padding: 3% 0; }
.tbl-full { width: 100%; }
table tr th { border-bottom: 1px solid black; padding: 1%; text-align: left; }
table tr td { padding: 1%; }
.btn-primary { background-color: #22a6b3; padding: 1%; color: white; text-decoration: none; font-weight: bold; }
.btn-primary:hover { background-color: #e056fd; }
.btn-secondary { background-color: #6ab04c; padding: 1%; color: white; text-decoration: none; font-weight: bold; }
.btn-secondary:hover { background-color: #badc58; }
.btn-danger { background-color: #eb4d4b; padding: 1%; color: white; text-decoration: none; font-weight: bold; }
.btn-danger:hover { background-color: #ff7979; }
.footer { text-align: center; font-size: 14px; color: #fff; background-color: #57606f; }
</style>
