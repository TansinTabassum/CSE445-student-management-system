<?php 
//start session 
session_start();

//create constants to store non-repeating values
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

//connect database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
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
        <h1>Add Food</h1>
        <br>

        <!-- Add Food Form -->
        <form action="" method="post" enctype="multipart/form-data">
             <table class="tbl-30">
                <tr>
                    <td>Title:</td>    
                    <td>
                        <input type="text" name="title" placeholder="Title of the food" required>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" step="0.01" required>  </td>
                </tr>
                <tr>
                    <td>Add Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" required>
                            <?php 
                            //fetch active categories from DB
                            $sql= "SELECT * FROM tbl_category WHERE active='yes'";
                            $res= mysqli_query($conn,$sql);
                            $count= mysqli_num_rows($res);

                            if($count>0){
                              while($row=mysqli_fetch_assoc($res)){
                                  $id =$row['id'];
                                  $title =$row['title'];
                                  echo "<option value='$id'>$title</option>";
                              }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no" checked>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" checked>Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
             </table>
        </form>

        <?php 
        //Check if submit button is clicked
        if(isset($_POST['submit'])) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : 'no';
            $active = isset($_POST['active']) ? $_POST['active'] : 'no';

            //Handle image upload
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food-".rand(0000,9999).".".$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/".$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if(!$upload) {
                    $_SESSION['upload'] = "<div style='color:red'>Failed to upload image.</div>";
                    $image_name = "";
                }
            } else {
                $image_name = "";
            }

            //Insert into database
            $sql2 = "INSERT INTO tbl_food SET 
                tittle='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'";

            $res2 = mysqli_query($conn, $sql2);

            if($res2){
                //Redirect to manage_food.php
                header("location: manage-food.php");
                exit;
            } else {
                echo "<div style='color:red'>Failed to add food. Error: ".mysqli_error($conn)."</div>";
            }
        }
        ?>

    </div>
  </div>

  <div class="footer">
    <div class="wrapper">
      <p class="text-center">&#169 2025 All rights reserved, web restaurant. Developed by Tansin Tabassum</p>
    </div>
   </div>
</body>
</html>


  <style>
       
        .wrapper {
            width: 80%;
            margin: 0 auto;
        }

        .menu,
        .main-content,
        .footer {
            
            padding: 20px;
           /* margin-bottom: 10px; */
            background-color: #fffefeff;
        }
        .clearfix{
          float: none;
          clear: both;

        }
        .menu{
          text-align: center;
          border-bottom: 1px solid black;
        }
        .menu a{
          position: relative;
          z-index: 10;
          
        }
        .menu ul{
          list-style-type: none;
        }
        .menu ul li{
          display: inline;
          padding: 1%;
        }
        .menu ul li a{
          text-decoration: none;
          font-weight: bold;
          color: #ff6b81;


        }

        .menu ul li a:hover{
          color: #57606f;
        }

        .main-content{
          
          background-color: #dfe4ea;
          padding: 3% 0;
        }
        .col-4{
          
          width: 20%;
          background-color: white;
          margin: 1%;
          padding: 1%;
          text-align: center;
          float: left;
        }
        .tbl-full{
          width: 100%;
        }
        table tr th{
          border-bottom: 1px solid black;
          padding: 1%;
          text-align: left;
        }
        table tr td{
          padding: 1%;
        }

        .btn-primary{
          background-color: #22a6b3;
          padding: 1%;
          color: white;
          text-decoration: none;
          font-weight: bold;
        }
        .btn-primary:hover{
          background-color: #e056fd;
        }

        .btn-secondary{
          background-color: #6ab04c;
          padding: 1%;
          color: white;
          text-decoration: none;
          font-weight: bold;
        }
        .btn-secondary:hover{
          background-color: #badc58;
        }
        
        .btn-danger{
          background-color: #eb4d4b;
          padding: 1%;
          color: white;
          text-decoration: none;
          font-weight: bold;
        }
        .btn-danger:hover{
          background-color: #ff7979;
        }


        .footer {
            text-align: center;
            font-size: 14px;
            color: #ffffffff;
            background-color: #57606f;
        }
    </style>
