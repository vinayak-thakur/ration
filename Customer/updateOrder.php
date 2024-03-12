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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get order details from the form
    $order_id = $_POST['order_id'];
    $rice_kg = $_POST['rice_kg'];
    $wheat_kg = $_POST['wheat_kg'];
    $sugar_kg = $_POST['sugar_kg'];

    // Update the order in the database
    $sqlUpdateOrder = "UPDATE purchased SET rice_kg = '$rice_kg', wheat_kg = '$wheat_kg', sugar_kg = '$sugar_kg' WHERE order_id = '$order_id' AND customer_id = '$customer_id'";
    $resultUpdateOrder = mysqli_query($con, $sqlUpdateOrder);

    if ($resultUpdateOrder) {
        echo "Order updated successfully.";
        // Redirect back to viewOrders.php after a short delay
        header("refresh:2;url=viewOrders.php");
        exit();
    } else {
        echo "Error updating order: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>