<?php
session_start();
include "header.php";
// Perform database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "DBMS";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle order confirmation or cancellation
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
} elseif (isset($_POST['cancel_order'])) {
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

// Fetch all purchased from the view
$sqlAllOrders = "SELECT * FROM order_view";
$resultAllOrders = mysqli_query($con, $sqlAllOrders);

// Display purchased in the bookings section
echo "<h2>All Bookings</h2>";

if ($resultAllOrders && mysqli_num_rows($resultAllOrders) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Order ID</th><th>Rice (kg)</th><th>Wheat (kg)</th><th>Sugar (kg)</th><th>Order State</th><th>Order Date</th><th>Customer Name</th><th>Customer Address</th><th>Customer Phone</th><th>Action</th></tr>";

    while ($orderRow = mysqli_fetch_assoc($resultAllOrders)) {
        echo "<tr>";
        echo "<td>{$orderRow['order_id']}</td>";
        echo "<td>{$orderRow['rice_kg']}</td>";
        echo "<td>{$orderRow['wheat_kg']}</td>";
        echo "<td>{$orderRow['sugar_kg']}</td>";
        echo "<td>{$orderRow['order_state']}</td>";
        echo "<td>{$orderRow['order_date']}</td>";
        echo "<td>{$orderRow['customer_name']}</td>";
        echo "<td>{$orderRow['customer_city']}</td>";
        echo "<td>{$orderRow['customer_contact']}</td>";

        // Check if the order is not confirmed to display the Confirm and Cancel buttons
        if ($orderRow['order_state'] !== 'Confirmed' && $orderRow['order_state'] !== 'Cancelled') {
            echo "<td>
                    <button> <a href='dispatchOrder.php?order_id={$orderRow['order_id']}'>Dispatch Order</a></button>
                    <button onclick='cancelOrder({$orderRow['order_id']})' style='background: red;'>Cancel</button>
                    <br>
                   
                </td>";
        } elseif ($orderRow['order_state'] === 'Confirmed') {
            echo "<td>Order Confirmed</td>";
        } elseif ($orderRow['order_state'] === 'Cancelled') {
            echo "<td>Order Cancelled</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}

mysqli_close($con);
?>

<link rel="stylesheet" href="Bookings.css">

<script>
    // function confirmOrder(orderId) {
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'confirmOrder.php', true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    //     // Set up the data to send
    //     var data = 'confirm_order=true&order_id=' + orderId;

    //     // Handle the response from confirmOrder.php
    //     xhr.onload = function () {
    //         if (xhr.status === 200) {
    //             try {
    //                 var response = JSON.parse(xhr.responseText);
    //                 if (response.success) {
    //                     // Update the order state in the table
    //                     var cell = document.querySelector(`[data-order-id="${orderId}"]`);
    //                     cell.innerHTML = 'Order Confirmed';
    //                 } else {
    //                     alert(response.message);
    //                 }
    //             } catch (e) {
    //                 console.error('Error parsing JSON:', e);
    //             }
    //         } else {
    //             console.error('Server error:', xhr.statusText);
    //         }
    //     };

    //     // Send the request
    //     xhr.send(data);
    // }

    function cancelOrder(orderId) {
        // Send AJAX request to cancelOrder.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cancelOrder.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Set up the data to send
        var data = 'cancel_order=true&order_id=' + orderId;

        // Handle the response from cancelOrder.php
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Update the order state in the table
                        var cell = document.querySelector(`[data-order-id="${orderId}"]`);
                        cell.innerHTML = 'Order Cancelled';
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            } else {
                console.error('Server error:', xhr.statusText);
            }
        };

        // Send the request
        xhr.send(data);
    }
</script>
