<?php
session_start();

// Database constants
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

// Connect to database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// ===== Handle form submission =====
if(isset($_POST['submit'])) {

    $food_id = intval($_POST['food_id']); // Store food ID
    $qty = intval($_POST['qty']);
    $status = $_POST['status'];

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    // Get food details from DB
    $sql_food = "SELECT tittle, price FROM tbl_food WHERE id=$food_id";
    $res_food = mysqli_query($conn, $sql_food);

    if($res_food && mysqli_num_rows($res_food) == 1){
        $row_food = mysqli_fetch_assoc($res_food);
        $food_name = $row_food['tittle'];
        $price = $row_food['price'];
        $total = $price * $qty;
        $order_date = date("Y-m-d H:i:s");

        // Insert order
        $sql_order = "INSERT INTO tbl_order SET
            food='$food_name',
            price='$price',
            qty='$qty',
            total='$total',
            status='$status',
            order_date='$order_date',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            customer_address='$customer_address'
        ";

        if(mysqli_query($conn, $sql_order)){
            header("Location: manage-order.php");
            exit;
        } else {
            $error = "Failed to place order: " . mysqli_error($conn);
        }

    } else {
        $error = "Selected food not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <style>
        .wrapper { width: 80%; margin: 0 auto; }
        .menu { text-align: center; margin-bottom: 20px; }
        .menu ul { list-style-type: none; padding: 0; }
        .menu ul li { display: inline; margin: 0 10px; }
        .menu ul li a { text-decoration: none; color: #ff6b81; font-weight: bold; }
        .menu ul li a:hover { color: #57606f; }
        .main-content { background-color: #dfe4ea; padding: 20px; }
        table { width: 50%; margin: 0 auto; }
        table td { padding: 10px; }
        input[type="text"], input[type="number"], input[type="email"], select, textarea { width: 100%; padding: 5px; }
        .btn-secondary { background-color: #6ab04c; padding: 8px 15px; color: white; text-decoration: none; border: none; font-weight: bold; cursor: pointer; }
        .btn-secondary:hover { background-color: #badc58; }
        .error { color: red; text-align: center; margin-bottom: 10px; }
    </style>

    <!-- Optional: JavaScript to auto-fill price -->
    <script>
        function updatePrice() {
            const foods = <?php
                $sql = "SELECT id, price FROM tbl_food WHERE active='yes'";
                $res = mysqli_query($conn, $sql);
                $arr = [];
                while($row = mysqli_fetch_assoc($res)){
                    $arr[$row['id']] = $row['price'];
                }
                echo json_encode($arr);
            ?>;

            const foodSelect = document.getElementById('food_id');
            const priceInput = document.getElementById('price');

            const selectedId = foodSelect.value;
            priceInput.value = selectedId ? foods[selectedId] : '';
        }
    </script>
</head>
<body>

<div class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-category.php">Category</a></li>
        <li><a href="manage-food.php">Food</a></li>
        <li><a href="manage-order.php">Order</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="wrapper">
        <h1>Place Order</h1>

        <?php if(isset($error)) { echo '<p class="error">'.$error.'</p>'; } ?>

        <form action="" method="post">
            <table>
                <tr>
                    <td>Select Food:</td>
                    <td>
                        <select name="food_id" id="food_id" onchange="updatePrice()" required>
                            <option value="">--Select Food--</option>
                            <?php
                            $sql_food = "SELECT * FROM tbl_food WHERE active='yes'";
                            $res_food = mysqli_query($conn, $sql_food);
                            while($row = mysqli_fetch_assoc($res_food)){
                                echo '<option value="'.$row['id'].'">'.$row['tittle'].' ('.$row['price'].' TK)</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" id="price" name="price" step="0.01" readonly required></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td><input type="number" name="qty" min="1" value="1" required></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" required></td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="customer_contact" required></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="email" name="customer_email"></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="customer_address" rows="4" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Place Order" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>
