<?php
session_start();

// Perform database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "DBMS";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle order confirmation
if (isset($_POST['confirm_order'])) {
    $order_id = $_POST['order_id'];

    // Update order status to 'Confirmed'
    $sqlUpdateOrder = "UPDATE purchased SET order_state = 'Confirmed' WHERE order_id = '$order_id'";
    $resultUpdateOrder = mysqli_query($con, $sqlUpdateOrder);

    // Check if the update was successful
    if ($resultUpdateOrder) {
        echo json_encode(['success' => true, 'message' => 'Order confirmed successfully.']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error confirming order.']);
        exit();
    }
}

mysqli_close($con);
?>
