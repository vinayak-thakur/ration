<?php
session_start(); // Start the session

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page or perform other actions if not logged in
    header("location: customerregistration.php");
    exit();
}

// Assuming you have 'id' as the customer ID in the session
$customer_id = $_SESSION['id'];

// Perform database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "dbms";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch customer name from the database
$sql = "SELECT name FROM customer_details WHERE id = '$customer_id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $customer_name = $row['name'];
} else {
    // Handle the case where customer name is not found
    $customer_name = "Customer";
}

// Fetch order details based on order_id
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $sqlOrderDetails = "SELECT * FROM purchased WHERE order_id = '$order_id' AND customer_id = '$customer_id'";
    $resultOrderDetails = mysqli_query($con, $sqlOrderDetails);

    if ($resultOrderDetails && mysqli_num_rows($resultOrderDetails) > 0) {
        $orderDetails = mysqli_fetch_assoc($resultOrderDetails);

        // Display the form for editing
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Order</title>
            <link rel="stylesheet" href="edit.css"> <!-- You can add your own CSS file if needed -->
        </head>
        <body>
            <h1>Edit Order <?php echo $order_id; ?></h1>
            <a href="viewOrders.php">Back to Orders</a>

            <form action="updateOrder.php" method="post">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <label for="rice_kg">Rice (kg):</label>
                <input type="number" name="rice_kg" value="<?php echo $orderDetails['rice_kg']; ?>" required>
                <br>
                <label for="wheat_kg">Wheat (kg):</label>
                <input type="number" name="wheat_kg" value="<?php echo $orderDetails['wheat_kg']; ?>" required>
                <br>
                <label for="sugar_kg">Sugar (kg):</label>
                <input type="number" name="sugar_kg" value="<?php echo $orderDetails['sugar_kg']; ?>" required>
                <br>
                <input type="submit" value="Update Order">
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "<p>Order not found or you don't have permission to edit this order.</p>";
    }
} else {
    echo "<p>Order ID not specified.</p>";
}

mysqli_close($con);
?>
