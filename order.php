
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

// Initialize variables
$showForm = true;
$orderPlaced = false;
$orderData = [];

// Handle form submission
if (isset($_POST['submit'])) {
    $food = mysqli_real_escape_string($conn, $_POST['food']);
    $price = floatval($_POST['price']);
    $qty = intval($_POST['qty']);
    $total = $price * $qty;

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";

    // Insert order into database
    $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
            VALUES ('$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $showForm = false; // hide form
        $orderPlaced = true;
        // Store order data to show
        $orderData = [
            'food' => $food,
            'price' => $price,
            'qty' => $qty,
            'total' => $total,
            'customer_name' => $customer_name,
            'customer_contact' => $customer_contact,
            'customer_email' => $customer_email,
            'customer_address' => $customer_address,
            'order_date' => $order_date,
            'status' => $status
        ];
    } else {
        echo "<div class='error'>Failed to place order: ".mysqli_error($conn)."</div>";
    }
}

// Get food details if food_id is passed in URL
if ($showForm && isset($_GET['food_id'])) {
    $food_id = intval($_GET['food_id']);

    $sql_food = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res_food = mysqli_query($conn, $sql_food);

    if (mysqli_num_rows($res_food) == 1) {
        $row = mysqli_fetch_assoc($res_food);
        $food = $row['tittle'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header("location: foods.php");
        exit;
    }
} elseif ($showForm) {
    header("location: foods.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Food</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">

<?php if ($showForm): ?>
    <h2>Fill this form to confirm your order</h2>

    <form action="" method="POST">

        <fieldset>
            <legend>Selected Food</legend>

            <?php if (!empty($image_name)) : ?>
                <div class="food-menu-img">
                    <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($food); ?>" style="width:150px;">
                </div>
            <?php else: ?>
                <div class='error'>Image not available</div>
            <?php endif; ?>

            <h3><?php echo htmlspecialchars($food); ?></h3>
            <p>Price: ৳<?php echo htmlspecialchars($price); ?></p>

            <input type="hidden" name="food" value="<?php echo htmlspecialchars($food); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">

            Quantity: <input type="number" name="qty" value="1" min="1" required>
        </fieldset>

        <fieldset>
            <legend>Customer Details</legend>

            Full Name: <input type="text" name="customer_name" placeholder="Enter your name" required><br><br>
            Phone: <input type="text" name="customer_contact" placeholder="Enter your contact" required><br><br>
            Email: <input type="email" name="customer_email" placeholder="Enter your email"><br><br>
            Address: <textarea name="customer_address" placeholder="Enter your address" required></textarea>
        </fieldset>

        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
    </form>

<?php elseif ($orderPlaced): ?>
    <h2>Order Placed Successfully!</h2>

    <table border ="1" cellpadding="10">
        <tr><th>Food</th><td><?php echo $orderData['food']; ?></td></tr>
        <tr><th>Price</th><td>৳<?php echo $orderData['price']; ?></td></tr>
        <tr><th>Quantity</th><td><?php echo $orderData['qty']; ?></td></tr>
        <tr><th>Total</th><td>৳<?php echo $orderData['total']; ?></td></tr>
        <tr><th>Customer Name</th><td><?php echo $orderData['customer_name']; ?></td></tr>
        <tr><th>Contact</th><td><?php echo $orderData['customer_contact']; ?></td></tr>
        <tr><th>Email</th><td><?php echo $orderData['customer_email']; ?></td></tr>
        <tr><th>Address</th><td><?php echo $orderData['customer_address']; ?></td></tr>
        <tr><th>Order Date</th><td><?php echo $orderData['order_date']; ?></td></tr>
        <tr><th>Status</th><td><?php echo $orderData['status']; ?></td></tr>
    </table>

    <br>
    <a href="foods.php" class="btn btn-secondary">Add Another Order</a>
    <a href="admin/manage-order.php" class="btn btn-primary">Go to Manage Orders</a>
<?php endif; ?>

</div>
</body>
</html>
