<?php
session_start(); // Start the session

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page or perform other actions if not logged in
    header("location: customerregistration.php");
    exit();
}

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

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="customer.css"> <!-- You can add your own CSS file if needed -->
</head>
<body>
    <h1>Welcome, <?php echo $customer_name; ?>!</h1>
    <a href="./logout.php">Logout</a>
    <a href="./viewOrders.php">View Orders</a>
    
    <?php include("bookOrder.php"); ?>
</body>
</html>
