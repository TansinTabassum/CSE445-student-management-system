
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

<?php 


require_once('../config/constants.php');
$id=$_GET['id'];
$sql=" SELECT * FROM tbl_admin WHERE id= $id";
$res= mysqli_query($conn,$sql);
if($res==true){
  $count = mysqli_num_rows($res);

if($count==1){
//echo "admin available";
$row=mysqli_fetch_assoc($res);
$full_name=$row["full_name"];
$username=$row["username"];

}
else{
  header("location:".SITEURL."admin/manage-admin.php");
}
  
}

?>




<div class="wrapper"><h1>update admin</h1>
<BR> <BR>
<form action="" method="post">
  <table class="tbl-30">
    <tr>
      <td>Full Name:</td>
      <td><input type="text" name="full_name" value="<?php echo $full_name; ?>" > </td>
    </tr>

    <tr>
      <td>Username:</td>
      <td> <input type="text" name="username" value="<?php echo $username; ?>">   </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
    </tr>

  </table>
</form>
</div>


<?php   //updating info
if(isset($_POST['submit']))
{
  //echo 'button clicked';

  //updating value and save it
  $id=$_POST['id'];
 $full_name=$_POST['full_name'];
  $username=$_POST['username'];

$sql =" UPDATE tbl_admin SET full_name ='$full_name', username='$username' WHERE id= '$id' ";

//execute querry 
$res = mysqli_query($conn,$sql);

if($res==true)
{
$_SESSION['update']=" admin update sucessfully";
header('location:' .SITEURL. 'admin/manage-admin.php');
}
else{
$_SESSION['update']="error";
header('location:' .SITEURL. 'admin/manage-admin.php');
}

}


?>




  <div class="footer">
    <div class="wrapper">
      <p class="text-center">&#169 2025 All rights reserved, web resturant. Developed by Tansin Tabassum</p>
    </div>
   </div>
  </body></html>
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



    


  <?php 

//start session 
//session_start();


//create constants to store none repeating values
//define('SITEURL','http://localhost/food-order/');
//define('LOCALHOST','localhost');
//define('DB_USERNAME','root');
//define('DB_PASSWORD','');
//define('DB_NAME','food-order');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));


?>