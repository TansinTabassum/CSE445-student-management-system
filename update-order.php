<?php
session_start();

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

// Check if order ID is passed
if(isset($_GET['id'])){
    $id = intval($_GET['id']); // sanitize input

    $sql = "SELECT * FROM tbl_order WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);
        $food = $row['food'];
        $price = $row['price'];
        $qty = $row['qty'];
        $total = $row['total'];
        $status = $row['status'];
        $customer_name = $row['customer_name'];
        $customer_contact = $row['customer_contact'];
        $customer_email = $row['customer_email'];
        $customer_address = $row['customer_address'];
    } else {
        header("location: manage-order.php");
        exit();
    }
} else {
    header("location: manage-order.php");
    exit();
}

// Handle form submission
if(isset($_POST['submit'])){
    $qty = intval($_POST['qty']);
    $total = $price * $qty;
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    $sql2 = "UPDATE tbl_order SET 
        qty=$qty,
        total=$total,
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'
        WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);

    if($res2){
        $_SESSION['update'] = "<div class='success'>Order updated successfully.</div>";
        header("location: manage-order.php");
        exit();
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Order</title>
    <style>
        .wrapper{width: 50%; margin: 0 auto; padding: 20px;}
        input, select, textarea{width: 100%; padding: 10px; margin: 5px 0;}
        .btn-primary{background-color:#22a6b3;color:white;padding:10px;text-decoration:none;border:none;cursor:pointer;}
        .btn-primary:hover{background-color:#1e90a3;}
    </style>
</head>
<body>
<div class="wrapper">
    <h1>Update Order</h1>

    <form action="" method="POST">
        <label>Food Name</label>
        <input type="text" name="food" value="<?php echo htmlspecialchars($food); ?>" disabled>

        <label>Price</label>
        <input type="number" name="price" value="<?php echo $price; ?>" disabled>

        <label>Quantity</label>
        <input type="number" name="qty" value="<?php echo $qty; ?>" min="1" required>

        <label>Status</label>
        <select name="status">
            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
        </select>

        <label>Customer Name</label>
        <input type="text" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>" required>

        <label>Customer Contact</label>
        <input type="text" name="customer_contact" value="<?php echo htmlspecialchars($customer_contact); ?>" required>

        <label>Customer Email</label>
        <input type="email" name="customer_email" value="<?php echo htmlspecialchars($customer_email); ?>" required>

        <label>Customer Address</label>
        <textarea name="customer_address" required><?php echo htmlspecialchars($customer_address); ?></textarea>

        <br>
        <input type="submit" name="submit" value="Update Order" class="btn-primary">
    </form>
</div>
</body>
</html>
