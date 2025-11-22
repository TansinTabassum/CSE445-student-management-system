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
            <h1>Manage Admin</h1>
           
           
          <?php  
if (isset($_SESSION['add'])) {
    // Show success message and hide the button
    echo '<div class="success">' . $_SESSION['add'] . '</div>';
    unset($_SESSION['add']); //  Remove the message after displaying it
} else {
    // Only show the button if there’s no success message
    echo '<a href="add-admin.php" class="btn-primary">Add Admin</a>';
}
 if(isset($_SESSION['delete']))
 {
  echo $_SESSION['delete'];
  unset($_SESSION['delete']);
 }
 if(isset($_SESSION['update']))
 {
  echo $_SESSION['update'];
  unset($_SESSION['update']);

 }

?>





<br> <br> <br>
            <table class="tbl-full">
              <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
              </tr>



<?php 
$sql = "SELECT * FROM tbl_admin";//query to get all admin 
$res = mysqli_query($conn,$sql); //execute the query

//check whweater the query is executed or not

if($res==true)
{ 

  //COUNT ROWS 
  $count = mysqli_num_rows($res);//function to get all the rows in database
  //check the number of rows 
  if($count>0)
  {    $sn = 1;
    //we have data in database 
    while($rows=mysqli_fetch_assoc($res))
    {
      //while loop to get data from database 
      //and while loop will run as long as we have data in database
      //get individual data
      $id=$rows["id"];
      $full_name=$rows["full_name"];
      $username=$rows["username"];

      //display the value 
      ?> 
          <tr>
                <td><?php echo $sn++; ?>.</td>
                <td><?php echo $full_name;?></td>
                <td><?php echo $username;?></td>
                <td>
                <a href="<?php echo SITEURL; ?>admin/Update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>   
                  
                                  
                </td>
              </tr>


      <?php
    }
  }
  else {
    //wedont have database 
  }
}


?>



              







              
            </table>
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

        .success {
    color: green;
    font-weight: bold;
    margin: 10px 0;
}
.error {
    color: red;
    font-weight: bold;
    margin: 10px 0;
}

    </style>
    
</html>
