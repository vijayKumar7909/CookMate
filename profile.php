<?php
session_start();

include "config.php";

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT name, email, profile_picture FROM users WHERE id = '$user_id'";

// Check if the query is successful
$user_result = $conn->query($sql_user);

if (!$user_result) {
    // If query fails, show the error
    die("Error fetching user details: " . $conn->error);
}

// Check if the user exists
if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    $profile_picture = $user['profile_picture'] ?: 'uploads/default_avatar.png';
} else {
    $profile_picture = 'uploads/default_avatar.png'; // Default profile picture
    die("User not found.");
}

// Fetch favorite recipes
$sql_favorites = "SELECT recipes.id, recipes.name, recipes.image FROM recipes 
                  JOIN user_favorites ON recipes.id = user_favorites.recipe_id 
                  WHERE user_favorites.user_id = '$user_id'";

$favorites_result = $conn->query($sql_favorites);

// Handle removing from favorites
if (isset($_GET['remove'])) {
    $recipe_id = $_GET['remove'];
    $sql_remove = "DELETE FROM user_favorites WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
    if ($conn->query($sql_remove) === TRUE) {
        $message = "Recipe removed from favorites!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
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

    <div class="profile-container">
        <h1>Welcome, <?= htmlspecialchars($user['name']) ?></h1>
        
        <div class="profile-details">
            <h2>Profile Information</h2>
            
            <!-- Display profile picture if exists -->
            <div class="profile-image" id="profile_img">
                <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile" class="profile-logo">

            </div>

            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="add_recipe.php">Add Recipe</a>
        </div>

        <div class="favorites">
            <h2>Your Favorite Recipes</h2>
            <div class="recipe-container">
                <?php
                if ($favorites_result->num_rows > 0) {
                    while ($row = $favorites_result->fetch_assoc()) {
                        echo '<div class="recipe-card">';
                        echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
                        echo '<h3><a href="recipe_details.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h3>';
                        echo '<a href="profile.php?remove=' . $row['id'] . '" class="remove-btn">Remove from Favorites</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>You haven't saved any recipes yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- <---------footer---------->

    <div id="footer">
        <div class="copy-right">
            <p>Copyright @ Vijay. Made with <i class="fa-sharp fa-solid fa-heart"></i> .</p>
        </div>

    </div>
</body>
</html>

<?php
$conn->close();
?>
