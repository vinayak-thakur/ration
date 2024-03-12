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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dispatch_order'])) {
    $order_id = $_POST['order_id'];
    $stock_id = $_POST['stock_id'];

    // Insert values into the order_released table
    $sqlInsertDispatched = "INSERT INTO order_released (order_id, stock_id) VALUES ('$order_id', '$stock_id')";
    $resultInsertDispatched = mysqli_query($con, $sqlInsertDispatched);

    if ($resultInsertDispatched) {
        // Update order state to 'Confirmed'
        $sqlUpdateOrder = "UPDATE purchased SET order_state = 'Confirmed' WHERE order_id = '$order_id'";
        $resultUpdateOrder = mysqli_query($con, $sqlUpdateOrder);

        if ($resultUpdateOrder) {
            // Redirect to bookings.php after successful dispatch
            header("Location: bookings.php");
            exit();
        } else {
            // Handle the error updating order state
            echo "Error updating order state: " . mysqli_error($con);
        }
    } else {
        // Handle the error inserting into order_released table
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch order details based on the selected order_id
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sqlOrderDetails = "SELECT * FROM order_view WHERE order_id = '$order_id'";
    $resultOrderDetails = mysqli_query($con, $sqlOrderDetails);

    if ($resultOrderDetails && $orderDetails = mysqli_fetch_assoc($resultOrderDetails)) {
        // Display order details and stock selection form
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="dispatch.css">
            <title>Dispatch Order</title>
        </head>
        <body>

        <div class="container">

        <h2>Dispatch Order</h2>
        <p>Order ID: <?php echo $orderDetails['order_id']; ?></p>
        <p>Customer Name: <?php echo $orderDetails['customer_name']; ?></p>
        <!-- Display other order details as needed -->

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="order_id" value="<?php echo $orderDetails['order_id']; ?>">
            <label for="stock_id">Select Stock ID:</label>
            <select name="stock_id" required>
                <!-- Fetch and display available stock IDs from stock_left table -->
                <?php
                $sqlStockIDs = "SELECT id FROM stock_left";
                $resultStockIDs = mysqli_query($con, $sqlStockIDs);

                while ($stock = mysqli_fetch_assoc($resultStockIDs)) {
                    echo "<option value='{$stock['id']}'>{$stock['id']}</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" name="dispatch_order" value="Dispatch Order">
        </form>

        </div>

        </body>
        </html>

        <?php
    } else {
        echo "Order not found.";
    }
} else {
    echo "Order ID not provided.";
}

mysqli_close($con);
?>
