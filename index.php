<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Redirect to recipes page if logged in
    header("Location: recipes.php");
    exit();
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>
