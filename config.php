<?php

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "cookmate");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
