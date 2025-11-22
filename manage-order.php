<?php 
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>



<?php 
session_start();

// Database constants
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Connect to DB
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <style>
        .wrapper {
            width: 95%;
            margin: 0 auto;
        }

        .menu, .main-content, .footer {
            padding: 20px;
            background-color: #fffefeff;
        }

        .menu {
            text-align: center;
            border-bottom: 1px solid black;
        }

        .menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li {
            display: inline-block;
            margin: 0 10px;
        }

        .menu ul li a {
            text-decoration: none;
            font-weight: bold;
            color: #ff6b81;
        }

        .menu ul li a:hover {
            color: #57606f;
        }

        .main-content {
            background-color: #dfe4ea;
            padding: 20px 0;
        }

        h1 {
            text-align: center;
        }

        .btn-primary, .btn-secondary, .btn-danger {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            font-size: 13px;
            display: inline-block;
            margin: 2px 0;
        }

        .btn-primary { background-color: #22a6b3; }
        .btn-primary:hover { background-color: #1e90a3; }

        .btn-secondary { background-color: #6ab04c; }
        .btn-secondary:hover { background-color: #badc58; }

        .btn-danger { background-color: #eb4d4b; }
        .btn-danger:hover { background-color: #ff7979; }

        .tbl-full {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* keeps columns within table width */
        }

        .tbl-full th, .tbl-full td {
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            overflow: hidden;
            border-bottom: 1px solid #ccc;
        }

        .tbl-full th {
            font-weight: bold;
            border-bottom: 2px solid #333;
        }

        /* truncate long customer info */
        .customer-info {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* make table horizontally scrollable on small screens */
        .table-responsive {
            overflow-x: auto;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #ffffff;
            background-color: #57606f;
            padding: 10px 0;
        }
    </style>
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
        <h1>Manage Orders</h1>

        <a href="<?php echo SITEURL; ?>place_order.php" class="btn-primary">Place Order</a>
        <br><br>

        <div class="table-responsive">
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);
            $sn = 1;

            if($res){
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td>৳<?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>৳<?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td class="customer-info"><?php echo $customer_name; ?></td>
                            <td class="customer-info"><?php echo $customer_contact; ?></td>
                            <td class="customer-info"><?php echo $customer_email; ?></td>
                            <td class="customer-info"><?php echo $customer_address; ?></td>
                            <td>
                                <a href="update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>

                    <?php
                    }
                } else {
                    echo "<tr><td colspan='12' class='error'>No orders available</td></tr>";
                }
            }
            ?>
        </table>
        </div>
    </div>
</div>

<div class="footer">
    <div class="wrapper">
        <p>&#169; 2025 All rights reserved. Developed by Tansin Tabassum</p>
    </div>
</div>

</body>
</html>
