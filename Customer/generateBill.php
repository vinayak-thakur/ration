<?php
session_start();

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

// Fetch order details from the database based on order_id
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $sqlOrderDetails = "SELECT * FROM purchased WHERE order_id = '$order_id'";
    $resultOrderDetails = mysqli_query($con, $sqlOrderDetails);

    if ($resultOrderDetails && mysqli_num_rows($resultOrderDetails) > 0) {
        $orderDetails = mysqli_fetch_assoc($resultOrderDetails);

        // Fetch customer color
        $sqlCustomerColor = "SELECT color FROM customer_details WHERE id = '$customer_id'";
        $resultCustomerColor = mysqli_query($con, $sqlCustomerColor);

        if ($resultCustomerColor && mysqli_num_rows($resultCustomerColor) > 0) {
            $customerColor = mysqli_fetch_assoc($resultCustomerColor)['color'];

            // Fetch prices based on customer color
            $sqlPrices = "SELECT rice, wheat, sugar FROM price WHERE color = '$customerColor'";
            $resultPrices = mysqli_query($con, $sqlPrices);

            if ($resultPrices && mysqli_num_rows($resultPrices) > 0) {
                $prices = mysqli_fetch_assoc($resultPrices);

                // Calculate total price
                $totalPrice = $orderDetails['rice_kg'] * $prices['rice'] +
                              $orderDetails['wheat_kg'] * $prices['wheat'] +
                              $orderDetails['sugar_kg'] * $prices['sugar'];

                // Insert invoice information into the 'invoice' table
                $insertBillSQL = "INSERT INTO invoice (customer_id, order_id, total_amount, bill_date) 
                                VALUES ('$customer_id', '$order_id', '$totalPrice', NOW())";
                $resultInsertBill = mysqli_query($con, $insertBillSQL);

                // Check if the insertion was successful
                if ($resultInsertBill) {
                    // Redirect to a page that displays invoice details from the 'invoice' table
                    header("location: viewBill.php?bill_id=" . mysqli_insert_id($con));
                    exit();
                } else {
                    echo "<p>Error inserting invoice information.</p>";
                }
            } else {
                echo "<p>Error fetching prices.</p>";
            }
        } else {
            echo "<p>Error fetching customer color.</p>";
        }
    } else {
        echo "<p>Error fetching order details.</p>";
    }
} else {
    echo "<p>Order ID not specified.</p>";
}

mysqli_close($con);
?>
