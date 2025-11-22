<?php 
// Start Session
session_start();

// Create constants
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Database Connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

// Check if search keyword is set
if(isset($_POST['search']))
{
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}
else
{
    header("location:".SITEURL);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="<?php echo SITEURL ?>"><img src="images/logo.jpeg" class="img-responsive"></a>
        </div>

        <div class="menu text-right">
            <ul>
                <li><a href="<?php echo SITEURL ?>">Home</a></li>
                <li><a href="<?php echo SITEURL ?>categories.php">Categories</a></li>
                <li><a href="<?php echo SITEURL ?>foods.php">Foods</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</section>

<section class="food-search text-center">
    <div class="container">
        <h2>Foods matching your search: <span class="text-white">"<?php echo $search; ?>"</span></h2>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // SQL Query to get food based on search
        $sql = "SELECT * FROM tbl_food 
                WHERE title LIKE '%$search%' 
                OR description LIKE '%$search%'";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count > 0)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php 
                    if($image_name=="")
                    {
                        echo "<div class='error'>Image Not Available</div>";
                    }
                    else
                    {
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" 
                             class="img-responsive img-curve">
                    <?php 
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">৳<?php echo $price; ?></p>
                    <p class="food-detail"><?php echo $description; ?></p>
                    <br>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" 
                       class="btn btn-primary">Order Now</a>
                </div>
            </div>

        <?php
            }
        }
        else
        {
            echo "<div class='error text-center'>No foods found matching your search.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

</body>
</html>
