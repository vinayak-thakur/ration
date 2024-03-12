<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="customerLogin.css"> <!-- Add your CSS file for styling -->
</head>
<body>
<?php include "../OutHeader.php"; ?>
    <div class="container">
        <h1>Customer Login</h1>
        <?php
        session_start(); // Start the session

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // If the user is already logged in, redirect to customer.php
            header("location: customer.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle login form submission
            $server = "localhost";
            $username = "root";
            $password = "";
            $con = mysqli_connect($server, $username, $password, "DBMS");

            if (!$con) {
                die("Connection to the database failed due to" . mysqli_connect_error());
            }

            $id = $_POST['id'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM `customer_details` WHERE `id`='$id' AND `password`='$password';";
            $result = $con->query($sql);
            
            if ($result->num_rows == 1) {
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $id;
                header("location: customer.php");
                exit();
            } else {
                echo "<p class='error'>Invalid credentials. Please try again.</p>";
            }

            $con->close();
        }
        ?>
        <form action="" method="post">
            <input type="number" name="id" id="id" placeholder="Enter Id" required>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <div style = "text-align: center; margin: 1rem 0; ">Not Registered ?  </div>
        <button onClick = "gotoRegistration()" style = "background: #3498db">Register</button>
    </div>
</body>
<script>
        const gotoRegistration = ()=>{
          window.location.href = "customerregistration.php"
        }
      </script>
</html>
