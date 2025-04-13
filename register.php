<?php
session_start();

$conn = new mysqli("localhost", "root", "", "cookmate");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_user = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_user);

    if ($result->num_rows > 0) {
        $error = "User already exists with this email.";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CookMate</title>
    <link rel="stylesheet" href="css/log_style.css">
</head>

<body>
    <div class="container">
        <h1>Register for CookMate</h1>
        <?php if ($error) { ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
         <?php } ?>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <div class="bottom-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>

</html>