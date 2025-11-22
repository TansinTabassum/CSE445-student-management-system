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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.jpeg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
   
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/BIRI.jpg"alt="burger" class="img-responsive img-curve">

                <h3 class="float-text text-white">Biriyani</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/FISH-CURRY.jpg" alt="pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Fish Curry</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/chick-ball.jpg" alt="Momo" class="img-responsive img-curve">

                <h3 class="float-text text-white">Chicken Ball</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/fish-fin.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Fish Finger</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/grill-chick.jpg" alt="Burger" class="img-responsive img-curve">

                <h3 class="float-text text-white">Grill Chicken</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/sp-roll.jpg" alt="Momo" class="img-responsive img-curve">

                <h3 class="float-text text-white">Spring Roll</h3>
            </div>
            </a>
            <a href="#">
            <div class="box-3 float-container">
                <img src="images/tacos.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Birria Tacos</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/kebab.jpg" alt="Burger" class="img-responsive img-curve">

                <h3 class="float-text text-white">Beef Kebab</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/samosa.jpg" alt="Momo" class="img-responsive img-curve">

                <h3 class="float-text text-white">Samosa</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/burger.jpg" alt="Burger" class="img-responsive img-curve">

                <h3 class="float-text text-white">Burger</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/momo.jpg" alt="Momo" class="img-responsive img-curve">

                <h3 class="float-text text-white">Momo</h3>
            </div>
            </a>

            

            <div class="clearfix"></div>
        </div>
    </section>
    
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
  
    <section class="footer">
        <div class="container text-center">
           <p>&#169; All rights reserved. Designed By <a href="#">Tansin Tabassum</a></p>
        </div>
    </section>
   

</body>
</html>