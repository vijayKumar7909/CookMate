<?php
// Database connection (update with your own connection details)
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
$sql_user = "SELECT name, email, profile_picture FROM users WHERE id = '$user_id'";
$user_result = $conn->query($sql_user);

if (!$user_result) {
    // If query fails, show the error
    die("Error fetching user details: " . $conn->error);
}


if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    $profile_picture = $user['profile_picture'] ?: 'uploads/default_avatar.png';
} else {
    $profile_picture = 'uploads/default_avatar.png'; // Default profile picture
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $steps = $_POST['steps'];
    $cuisine = $_POST['cuisine'];
    $cook_time = $_POST['cook_time'];
    $diet_type = $_POST['diet_type'];

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "images/";
        $image_path = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    // SQL query to insert recipe into the database
    $sql = "INSERT INTO recipes (name, ingredients, steps, image, cuisine, cook_time, diet_type)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssis", $recipe_name, $ingredients, $steps, $image_path, $cuisine, $cook_time, $diet_type);

    if ($stmt->execute()) {
        $message = "Recipe added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Your CSS file -->
    <link rel="stylesheet" href="css/add_recipe.css"> <!-- Your CSS file -->
</head>

<body>

  <!-- ------------NavBar-------------- -->

  <div class="navbar">
        <div class="left-links">
            <a href="index.php">Home</a>
            <a href="favorites.php">My Favorites</a>
            <!-- <a href="about.php">About</a>
            <a href="contact.php">Contact</a> -->
        </div>
        <div class="right-links">
            <a href="logout.php" class="logout-button">Logout</a>
            <a href="profile.php">
                <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile" class="profile-logo">
            </a>
        </div>
    </div>

    <!-- Display success or error message -->
    <div id="message" style="color: green; margin-bottom: 15px;"></div>

    <!-- Recipe Form -->

    <h2>Add a New Recipe</h2>
    <form id="addRecipeForm" action="add_recipe.php" method="POST" enctype="multipart/form-data">
        <label for="recipeName">Recipe Name:</label>
        <input type="text" id="recipeName" name="recipe_name" required><br>

        <label for="recipeIngredients">Ingredients:</label>
        <textarea id="recipeIngredients" name="ingredients" required></textarea><br>

        <label for="recipeSteps">Steps:</label>
        <textarea id="recipeSteps" name="steps" required></textarea><br>

        <label for="recipeImage">Image:</label>
        <input type="file" id="recipeImage" name="image" accept="image/*"><br>

        <label for="recipeCuisine">Cuisine:</label>
        <input type="text" id="recipeCuisine" name="cuisine" required><br>

        <label for="recipeCookTime">Cook Time (in minutes):</label>
        <input type="number" id="recipeCookTime" name="cook_time" min="1" required><br>

        <label for="recipeDietType">Diet Type:</label>
        <select id="recipeDietType" name="diet_type" required>
            <option value="vegetarian">Vegetarian</option>
            <option value="non-vegetarian">Non-Vegetarian</option>
            <option value="vegan">Vegan</option>
            <option value="pescatarian">Pescatarian</option>
        </select><br>

        <button type="submit" class="btn">Add Recipe</button>
    </form>

    <script>

        document.getElementById("addRecipeForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission
            const formData = new FormData(this);

            fetch("add_recipe.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    const messageDiv = document.getElementById("message");
                    if (data.includes("Recipe added successfully")) {
                        messageDiv.style.color = "green";
                        messageDiv.textContent = "Recipe added successfully!";
                        // Optionally, reset the form
                        document.getElementById("addRecipeForm").reset();
                    } else {
                        messageDiv.style.color = "red";
                        messageDiv.textContent = "Error adding recipe: " + data;
                    }
                })
                .catch(error => {
                    const messageDiv = document.getElementById("message");
                    messageDiv.style.color = "red";
                    messageDiv.textContent = "An unexpected error occurred.";
                });
        });

    </script> <!-- JavaScript file for AJAX -->

</body>

</html>