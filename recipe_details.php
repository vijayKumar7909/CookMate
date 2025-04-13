<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "cookmate");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if recipe ID is provided
if (!isset($_GET['id'])) {
    echo "Recipe not found.";
    exit();
}

$recipe_id = $_GET['id'];

// Fetch recipe details
$sql = "SELECT * FROM recipes WHERE id = '$recipe_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Recipe not found.";
    exit();
}

$recipe = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <link rel="stylesheet" href="css/recipe_details.css"> <!-- Ensure the stylesheet is linked correctly -->
</head>

<body>
    <div class="recipe-details-container">
        <h1><?= htmlspecialchars($recipe['name']) ?></h1>

        <div class="recipe-details">
            <div class="recipe-image">
                <img src="<?= htmlspecialchars($recipe['image']) ?>" alt="<?= htmlspecialchars($recipe['name']) ?>"
                    class="recipe-image">
            </div>

            <div class="recipe-info">
                <p><strong>Cuisine:</strong> <?= htmlspecialchars($recipe['cuisine']) ?></p>
                <p><strong>Cook Time:</strong> <?= htmlspecialchars($recipe['cook_time']) ?> minutes</p>
                <p><strong>Diet Type:</strong> <?= htmlspecialchars($recipe['diet_type']) ?></p>

                <h3>Ingredients:</h3>
                <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

                <h3>Steps:</h3>
                <p><?= nl2br(htmlspecialchars($recipe['steps'])) ?></p>
            </div>
        </div>

        <div class="back_buttons">

            <div class="button-container">
                <a href="recipes.php" class="back-button">Back to Recipes</a>
            </div>
            <div class="button-container">
                <a href="profile.php" class="back-button">Back to Profile</a>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>