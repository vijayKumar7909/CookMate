<?php
session_start();

include "config.php";

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT name, email, profile_picture FROM users WHERE id = '$user_id'";
$user_result = $conn->query($sql_user);
$user = $user_result->fetch_assoc();

// Handle form submission (update profile)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Handle file upload (profile picture)
    $profile_picture = $user['profile_picture']; // Keep existing picture by default

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $upload_dir = 'uploads/';
        $profile_picture = $upload_dir . basename($_FILES['profile_picture']['name']);

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
            echo "Profile picture uploaded successfully.";
        } else {
            echo "Failed to upload profile picture.";
        }
    }

    // Update user details in the database
    $sql_update = "UPDATE users SET name = '$name', email = '$email', profile_picture = '$profile_picture' WHERE id = '$user_id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: profile.php"); // Redirect to profile page after update
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/log_styles.css">
</head>

<body>
    <div class="profile-container">
        <h1>Edit Profile</h1>

        <?php if (isset($message)) {
            echo "<p class='message'>$message</p>";
        } ?>

        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div><br>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <br>
            <div class="form-group form-group3">
                <label for="profile_picture">Profile Picture:</label><br>
                <center>

                    <?php if ($user['profile_picture']) { ?>
                        <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" width="100">
                    <?php } ?><br>
                </center>
                <input type="file" name="profile_picture" id="profile_picture">
            </div><br>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>