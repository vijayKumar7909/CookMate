<?php
session_start();

$conn = new mysqli("localhost", "root", "", "cookmate");
$error ="";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        header("Location: recipes.php");
        $error ="";
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CookMate</title>
    <link rel="stylesheet" href="css/log_style.css">
</head>
<body>
    <div class="container">
        <span><h3 style="color: red;"><?php if($error){
            echo "". $error ."";
        }?></h3></span>
        <h1>Login to CookMate</h1>
        <form action="" method="POST" >
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value=""  required>
            <button type="submit">Login</button>
        </form>
        <div class="bottom-link">
            <p>New user? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
