<?php
session_start();

include "config.php";

$user_id = $_SESSION['user_id'];
$sql_user = "SELECT name, email, profile_picture FROM users WHERE id = '$user_id'";
$user_result = $conn->query($sql_user);

if (!$user_result) {
    
    die("Error fetching user details: " . $conn->error);
}

// Check if the user exists
if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    $profile_picture = $user['profile_picture'] ?: 'uploads/default_avatar.png';
} else {
    $profile_picture = 'uploads/default_avatar.png'; 
    die("User not found.");
}


// Remove recipe from favorites if requested
if (isset($_POST['remove'])) {
    $recipe_id = $_POST['recipe_id'];
    $sql_remove = "DELETE FROM user_favorites WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
    if ($conn->query($sql_remove) === TRUE) {
        $message = "Recipe removed from favorites!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch user's favorite recipes
$sql = "SELECT r.id, r.name, r.image, r.cuisine, r.cook_time, r.diet_type 
        FROM recipes r
        INNER JOIN user_favorites uf ON r.id = uf.recipe_id
        WHERE uf.user_id = '$user_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites - CookMate</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!-- ------------NavBar-------------- -->

    <div class="navbar">
        <div class="left-links">
            <a href="index.php">Home</a>
            <a href="favorites.php">My Favorites</a>
        </div>
        <div class="right-links">
            <a href="logout.php" class="logout-button">Logout</a>
            <a href="profile.php">
                <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile" class="profile-logo">
            </a>
        </div>
    </div>

    <!-- ------------------Body---------------- -->
    <div id="content">
        <h1>My Favorite Recipes</h1>

        <?php if (isset($message))
            echo "<p class='success'>$message</p>"; ?>
        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>

        <div class="recipe-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="recipe-card">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
                    echo '<h3><a href="recipe_details.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h3>';
                    echo '<p><strong>Cuisine:</strong> ' . $row['cuisine'] . '</p>';
                    echo '<p><strong>Cook Time:</strong> ' . $row['cook_time'] . ' minutes</p>';
                    echo '<p><strong>Diet Type:</strong> ' . $row['diet_type'] . '</p>';
                    echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="recipe_id" value="' . $row['id'] . '">';
                    
                    echo '<button type="submit" name="remove">Remove from Favorites</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>You have no favorite recipes yet. <a href='recipes.php' style='text-decoration : none;'>Browse Recipes</a></p>";
            }
            ?>
        </div>

    </div>
    
    <div id="footer">
        <div class="copy-right">
            <p>Copyright @ Vijay. Made with <i class="fa-sharp fa-solid fa-heart"></i> .</p>
        </div>

    </div>
</body>

</html>
<?php $conn->close(); ?>