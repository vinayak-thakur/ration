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

// Handle order cancellation
if (isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];

    // Update order status to 'Cancelled'
    $sqlCancelOrder = "UPDATE purchased SET order_state = 'Cancelled' WHERE order_id = '$order_id'";
    $resultCancelOrder = mysqli_query($con, $sqlCancelOrder);

    // Check if the update was successful
    if ($resultCancelOrder) {
        echo json_encode(['success' => true, 'message' => 'Order cancelled successfully.']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error cancelling order.']);
        exit();
    }
}

mysqli_close($con);
?>
