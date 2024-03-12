<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("location: customerLogin.php"); // Redirect to login page or any other page