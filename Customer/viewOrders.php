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

// Fetch all purchased placed by the customer
$sqlOrders = "SELECT * FROM purchased WHERE customer_id = '$customer_id'";
$resultOrders = mysqli_query($con, $sqlOrders);

// Fetch color from customer_details for pricing
$sqlColor = "SELECT color FROM customer_details WHERE id = '$customer_id'";
$resultColor = mysqli_query($con, $sqlColor);
$color = mysqli_fetch_assoc($resultColor)['color'];

// Function to calculate total amount based on color
function calculateTotalAmount($rice, $wheat, $sugar, $color) {
    // Fetch pricing based on color from the price table
    global $con;
    $sqlPrice = "SELECT rice, wheat, sugar FROM price WHERE color = '$color'";
    $resultPrice = mysqli_query($con, $sqlPrice);
    $priceRow = mysqli_fetch_assoc($resultPrice);

    // Calculate total amount
    $totalAmount = ($rice * $priceRow['rice']) + ($wheat * $priceRow['wheat']) + ($sugar * $priceRow['sugar']);
    return $totalAmount;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="viewOrders.css"> <!-- You can add your own CSS file if needed -->
</head>
<body>
    <h1>Orders Placed by <?php echo $customer_name; ?></h1>
    <a href="./logout.php">Logout</a>
    <a href="customer.php">Back to Dashboard</a>

    <?php
    if ($resultOrders && mysqli_num_rows($resultOrders) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Order ID</th><th>Rice (kg)</th><th>Wheat (kg)</th><th>Sugar (kg)</th><th>Order State</th><th>Order Date</th><th>Action</th></tr>";

        while ($orderRow = mysqli_fetch_assoc($resultOrders)) {
            echo "<tr>";
            echo "<td>{$orderRow['order_id']}</td>";
            echo "<td>{$orderRow['rice_kg']}</td>";
            echo "<td>{$orderRow['wheat_kg']}</td>";
            echo "<td>{$orderRow['sugar_kg']}</td>";
            echo "<td>{$orderRow['order_state']}</td>";
            echo "<td>{$orderRow['order_date']}</td>";

            // Check if the order is cancelled
            if ($orderRow['order_state'] === 'Cancelled') {
                echo "<td>Order Cancelled</td>";
            } else {
                // Check if the invoice is already generated for this order
                $order_id = $orderRow['order_id'];
                $sqlCheckBill = "SELECT * FROM invoice WHERE order_id = '$order_id'";
                $resultCheckBill = mysqli_query($con, $sqlCheckBill);

                if ($resultCheckBill && mysqli_num_rows($resultCheckBill) === 0) {
                    // If the invoice is not generated, provide an option to generate
                    echo "<td><a href='generateBill.php?order_id={$orderRow['order_id']}'>Generate Bill</a></td>";
                } else {
                    // Display a button to view the invoice
                    $sqlGetBillId = "SELECT bill_id FROM invoice WHERE order_id = '$order_id'";
                    $resultGetBillId = mysqli_query($con, $sqlGetBillId);
                    $billId = mysqli_fetch_assoc($resultGetBillId)['bill_id'];

                    echo "<td><a href='viewBill.php?bill_id={$billId}'>View Bill</a></td>";
                }

                // Check if the order is pending, then provide an option to edit
                if ($orderRow['order_state'] === 'Pending') {
                    echo "<td><a href='editOrder.php?order_id={$orderRow['order_id']}'>Edit Order</a></td>";
                } else {
                    echo "<td></td>";
                }
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No purchased found.</p>";
    }
    mysqli_close($con);
    ?>
</body>
</html>
