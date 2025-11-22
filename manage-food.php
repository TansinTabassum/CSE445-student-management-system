<?php 

session_start();

// Create constants
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Connect to database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food</title>
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
        <h1>Manage Food</h1>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
            // Fetch foods from tbl_food
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            $sn = 1;

            if(mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $tittle = $row['tittle'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo htmlspecialchars($tittle); ?></td>
                        <td>৳<?php echo htmlspecialchars($price); ?></td>
                        <td>
                            <?php 
                            if($image_name != "") {
                                echo "<img src='../images/$image_name' width='100px'>";
                            } else {
                                echo "<span style='color:red'>Image not added</span>";
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($featured); ?></td>
                        <td><?php echo htmlspecialchars($active); ?></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Food</a>
                            <a href="#" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' style='color:red'>No Food Added Yet.</td></tr>";
            }
            ?>

        </table>
    </div>
  </div>

  <div class="footer">
    <div class="wrapper">
      <p class="text-center">&#169 2025 All rights reserved, web restaurant. Developed by Tansin Tabassum</p>
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
    background-color: #fffefeff;
}

.menu{
  text-align: center;
  border-bottom: 1px solid black;
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

.tbl-full{
  width: 100%;
  border-collapse: collapse;
}

table tr th, table tr td{
  border-bottom: 1px solid black;
  padding: 1%;
  text-align: left;
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
