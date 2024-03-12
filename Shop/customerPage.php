<?php
$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password, "DBMS");

if(!$con){
    die("Connection to the database failed due to" . mysqli_connect_error());
}

if(isset($_GET['id'])){
    $customer_id = $_GET['id'];

    $sql = "SELECT * FROM `customer_details` WHERE `id`='$customer_id';";
    $result = $con->query($sql);

    if($result->num_rows > 0){
        $customer_data = $result->fetch_assoc();
        echo "<h1>Customer Information</h1>";
        echo "<p>ID: " . $customer_data['id'] . "</p>";
        echo "<p>Name: " . $customer_data['name'] . "</p>";
        echo "<p>Family Count: " . $customer_data['family_count'] . "</p>";
        echo "<p>Contact: " . $customer_data['contact'] . "</p>";
        echo "<p>City: " . $customer_data['city'] . "</p>";
    } else {
        echo "<p>Customer not found</p>";
    }
} else {
    
    echo "<p>Invalid customer ID</p>";
}

$con->close();
?>
