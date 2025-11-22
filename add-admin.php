<?php  
if (isset($_POST["submit"])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 // for password encryption 

    // Connect to DB
    //$conn = mysqli_connect('localhost', 'root', '') or die("Connection failed: " . mysqli_connect_error());
   // $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error($conn));
//create constants to store none repeating values

//start session 
session_start();

define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

    // SQL query - safer syntax
    $sql = "INSERT INTO tbl_admin (full_name, username, password) 
            VALUES ('$full_name', '$username', '$password')";

    // Execute query
    //$res = mysqli_query($conn, $sql);

    // Feedback
    
   //executing querry and saving data into database
   $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

   /*if ($res) {
       echo "<script>alert('Admin added successfully.');</script>";
    } else {
        echo "MySQL Error: " . mysqli_error($conn);
        echo "<script>alert('Failed to add admin.');</script>";

   }*/

   
//check weather data is inserted
if($res == true)
{
  //DATA IS INSERTED 
//echo "data inserted";
//for display msg
$_SESSION['add']="Admin Added succesfully";
header('location:'. SITEURL .'admin/manage-admin.php');
}
else{
  //failed inserted data
  //echo "data failed to inserted"; 
  //for display msg
$_SESSION['add']="failed Added succesfully";
header('location:'.SITEURL.'admin/add-admin.php');
}
}

//create constants to store none repeating values

?>
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    
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
        <h1>Add Admin</h1>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type ="text" name="full_name" placeholder="  Enter your name"></td>
                </tr>
                     <tr>
                    <td>Username</td>
                    <td><input type ="text" name="username" placeholder="  Enter your username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type ="Password" name="password" placeholder="  Enter your password"></td>
                </tr>

                <tr>
                      <td colspan="2">
                     <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                      </td>
                </tr>
            </table>
        </form>
    </div>
  </div>
  <div class="footer">
    <div class="wrapper">
      <p class="text-center">&#169 2025 All rights reserved, web resturant. Developed by Tansin Tabassum</p>
    </div>
   </div>
  </body>

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
        .tbl-30{
            width: 30%;
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
    </html>



    