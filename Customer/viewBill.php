<?php
session_start();

// Perform database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "dbms";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch invoice details from the 'invoice' table based on bill_id
if (isset($_GET['bill_id'])) {
    $bill_id = $_GET['bill_id'];

    // Fetch invoice details
    $sqlBillDetails = "SELECT * FROM invoice WHERE bill_id = '$bill_id'";
    $resultBillDetails = mysqli_query($con, $sqlBillDetails);

    if ($resultBillDetails && mysqli_num_rows($resultBillDetails) > 0) {
        $billDetails = mysqli_fetch_assoc($resultBillDetails);

        // Fetch customer name from the 'customer_details' table
        $customer_id = $billDetails['customer_id'];
        $sqlCustomerName = "SELECT name FROM customer_details WHERE id = '$customer_id'";
        $resultCustomerName = mysqli_query($con, $sqlCustomerName);

        if ($resultCustomerName && mysqli_num_rows($resultCustomerName) > 0) {
            $customer_name = mysqli_fetch_assoc($resultCustomerName)['name'];

            // Fetch order details from the 'purchased' table
            $order_id = $billDetails['order_id'];
            $sqlOrderDetails = "SELECT * FROM purchased WHERE order_id = '$order_id'";
            $resultOrderDetails = mysqli_query($con, $sqlOrderDetails);

            if ($resultOrderDetails && mysqli_num_rows($resultOrderDetails) > 0) {
                // Display the invoice details in a table
                echo "<!DOCTYPE html>";
                echo "<html lang='en'>";
                echo "<head>";
                echo "    <meta charset='UTF-8'>";
                echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
                echo "    <title>View Bill</title>";
                // Add the link to the CSS file here
                echo "    <link rel='stylesheet' href='./viewBill.css'>";
                echo "</head>";
                echo "<body>";
                
                // Buttons for Back to Dashboard and Logout
                echo "    <a href='customer.php'>Back to Dashboard</a>";
                echo "    <a href='./logout.php'>Logout</a>";
                echo "    <h2>Bill Details</h2>";
                
                // Display customer name, total amount, and invoice date
                echo "<table border='1'>";
                echo "<tr><th>Customer Name</th><th>Order ID</th><th>Rice (kg)</th><th>Wheat (kg)</th><th>Sugar (kg)</th><th>Total Amount</th><th>Bill Date</th></tr>";

                while ($orderDetails = mysqli_fetch_assoc($resultOrderDetails)) {
                    echo "<tr>";
                    echo "<td>{$customer_name}</td>";
                    echo "<td>{$orderDetails['order_id']}</td>";
                    echo "<td>{$orderDetails['rice_kg']}</td>";
                    echo "<td>{$orderDetails['wheat_kg']}</td>";
                    echo "<td>{$orderDetails['sugar_kg']}</td>";
                    echo "<td>{$billDetails['total_amount']}</td>";
                    echo "<td>{$billDetails['bill_date']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
                // Save Bill button below the table
                echo "<button id='saveButton'>Save Bill</button>";
                echo "</body>";
                echo "</html>";
            } else {
                echo "<p>Error fetching order details.</p>";
            }
        } else {
            echo "<p>Error fetching customer name.</p>";
        }
    } else {
        echo "<p>Error fetching invoice details.</p>";
    }
} else {
    echo "<p>Bill ID not specified.</p>";
}

mysqli_close($con);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script>
document.getElementById('saveButton').addEventListener('click', function() {
    // Convert the invoice content to image and save as JPEG
    domtoimage.toBlob(document.querySelector('table'))
        .then(function(blob) {
            saveAs(blob, 'invoice.jpeg');
        });
});
</script>