


<?php
session_start();

// Database constants
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

// Connect to database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1 class="text-center">Food Menu</h1>

    <?php
    // Show success message from previous order
    if (isset($_SESSION['order'])) {
        echo "<div class='success'>" . $_SESSION['order'] . "</div>";
        unset($_SESSION['order']);
    }

    // Fetch all active food items from database
    $sql = "SELECT * FROM tbl_food WHERE active='yes'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $tittle = $row['tittle'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if ($image_name != "") {
                        echo "<img src='images/food/$image_name' alt='$tittle' class='img-responsive img-curve'>";
                    } else {
                        echo "<div class='error'>Image not available</div>";
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $tittle; ?></h4>
                    <p class="food-price">৳<?php echo $price; ?></p>
                    <p class="food-detail"><?php echo $description; ?></p>
                    <br>
                    <!-- Order Now button -->
                    <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<div class='error'>No food items available.</div>";
    }
    ?>
</div>

</body>
</html>

