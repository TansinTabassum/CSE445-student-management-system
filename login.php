<?php
// Start the session before any output
session_start();

// Database configuration
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Connect to database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

// Handle login form submission
if(isset($_POST['submit'])){
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // Fetch user by username
  $sql = "SELECT * FROM tbl_admin WHERE username='$username'";
  $res = mysqli_query($conn, $sql);

  if($res && mysqli_num_rows($res) == 1){
      $row = mysqli_fetch_assoc($res);
      $stored_pass = $row['password'];

      // Check for plain-text or hashed passwords
      if ($password === $stored_pass || password_verify($password, $stored_pass)) {
          $_SESSION['login'] = "<div class='success'>Login successful</div>";
          $_SESSION['user'] = $username; // track logged-in user
          header('location:'.SITEURL.'admin/');
          exit;
      } else {
          $_SESSION['login'] = "<div class='error'>Incorrect password</div>";
          header('location:'.SITEURL.'admin/login.php');
          exit;
      }
  } else {
      $_SESSION['login'] = "<div class='error'>Username not found</div>";
      header('location:'.SITEURL.'admin/login.php');
      exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Order System</title>
  
</head>
<body>
  <div class="login">
    <h1>Login</h1>
    <?php 
      if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
      if(isset($_SESSION['no-login-msg'])){
        echo $_SESSION['no-login-msg'];
        unset($_SESSION['no-login-msg']);
      }
    ?>
    <form action="" method="POST">
      <p>Username:</p>
      <input type="text" name="username" placeholder="Enter Username" required><br><br>
      <p>Password:</p>
      <input type="password" name="password" placeholder="Enter Password" required><br><br>
      <input type="submit" name="submit" value="Login" class="btn-primary">
    </form>
    <p>Created by - <a href="https://www.tansintabassum.com">Tansin Tabassum</a></p>
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


        /*css for login */
        .login{
          width: 30%;
          border: 1px solid grey;
          margin: 10% auto;
          padding: 2%;
          text-align: center;


        }
        .error{
          color:red;
        }
        .success{
          color: green;
        }
        .btn{
    padding: 1%;
    border: none;
    font-size: 1rem;
    border-radius: 5px;
}
.btn-primary{
    background-color: #16c7fdff;
    color: rgb(12, 12, 12);
    cursor: pointer;
}
.btn-primary:hover{
    color: white;
    background-color: #408f1cff;
}


        .footer {
            text-align: center;
            font-size: 14px;
            color: #ffffffff;
            background-color: #57606f;
        }
    </style>