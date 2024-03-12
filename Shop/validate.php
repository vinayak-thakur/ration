<?php

include_once('connection.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] == $password) {
        $_SESSION['username'] = $username; // Store the username in the session
        header("location: adminpage.php");
        exit(); // Add this line to ensure that no further code is executed after the redirect
    } else {
        echo "<script language='javascript'>";
        echo "alert('WRONG INFORMATION')";
        echo "</script>";
        die();
    }
} else {
    // Redirect to login page if accessed directly without POST request
    header("location: index.php");
    exit();
}
?>
