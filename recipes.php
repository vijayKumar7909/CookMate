<?php
session_start();

include "config.php";

// Fetch user details

$user_id = $_SESSION['user_id'];
$sql_user = "SELECT profile_picture FROM users WHERE id = '$user_id'";
$result_user = $conn->query($sql_user);


// Save to favorites if the button is clicked

if (isset($_POST['save'])) {
    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];

    $sql_save = "INSERT INTO user_favorites (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')";

    if ($conn->query($sql_save) === TRUE) {
        $message = "Recipe saved to favorites!";
    } else {
        $message = "Error: " . $conn->error;
    }
}


if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
    $profile_picture = $user['profile_picture'] ?: 'uploads/default_avatar.png';
} else {
    $profile_picture = 'uploads/default_avatar.png'; 
}

// Fetch filters and search term

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$cuisine = isset($_GET['cuisine']) ? $conn->real_escape_string($_GET['cuisine']) : '';
$diet_type = isset($_GET['diet_type']) ? $conn->real_escape_string($_GET['diet_type']) : '';
$cook_time = isset($_GET['cook_time']) ? (int) $_GET['cook_time'] : 0;

// Build the query
$sql = "SELECT * FROM recipes WHERE 1=1";
if ($search) {
    $sql .= " AND name LIKE '%$search%'";
}
if ($cuisine) {
    $sql .= " AND cuisine = '$cuisine'";
}
if ($diet_type) {
    $sql .= " AND diet_type = '$diet_type'";
}
if ($cook_time) {
    $sql .= " AND cook_time <= $cook_time";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookMate Recipes</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4fb7d3260d.js" crossorigin="anonymous"></script>
    <!-- for importing icons -->
    <script src="js/feedback.js"></script>
</head>

<body id="rec_body">
    <div id="content">
        <div class="navbar">
            <div class="left-links">
                <a href="index.php">Home</a>
                <a href="favorites.php">My Favorites</a>
                <a href="#about_section">About</a>
                <a href="#footer">Contact</a>
            </div>
            <div class="right-links">
                <a href="logout.php" class="logout-button">Logout</a>
                <a href="profile.php">
                    <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile" class="profile-logo">
                </a>
            </div>

        </div>

        <!-- -----Filtering Recipies  ------------>

        <div class="filter-container">
            <form id="filterForm">
                <input type="text" name="search" id="search" placeholder="Search recipes..."
                    value="<?= htmlspecialchars($search) ?>">
                <select name="cuisine" id="cuisine">
                    <option value="">All Cuisines</option>
                    <option value="Indian" <?= $cuisine === 'Indian' ? 'selected' : '' ?>>Indian</option>
                    <option value="Chinese" <?= $cuisine === 'Chinese' ? 'selected' : '' ?>>Chinese</option>
                    <option value="American" <?= $cuisine === 'American' ? 'selected' : '' ?>>American</option>
                </select>
                <select name="diet_type" id="diet_type">
                    <option value="">All Diet Types</option>
                    <option value="Vegetarian" <?= $diet_type === 'Vegetarian' ? 'selected' : '' ?>>Vegetarian</option>
                    <option value="Non-Vegetarian" <?= $diet_type === 'Non-Vegetarian' ? 'selected' : '' ?>>Non-Vegetarian</option>
                </select>
                <input type="number" name="cook_time" id="cook_time" placeholder="Cook Time (mins)"
                    value="<?= htmlspecialchars($cook_time) ?>">
                <button type="button" id="applyFilters">Apply Filters</button>
            </form>
        </div>

        <div class="heading_bttn">
            <h1>Welcome to CookMate Recipes</h1>
        </div>

        <div class="message">
            <p id="fav_Message" style="display: none; color: green; font-weight: bold;"></p>
        </div>


        <div class="recipe-container" id="recipeContainer">

            <!-- Recipes will be dynamically updated here -->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="recipe-card">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
                    echo '<h2><a href="recipe_details.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h2>';
                    echo '<p><strong>Cuisine:</strong> ' . $row['cuisine'] . '</p>';
                    echo '<p><strong>Cook Time:</strong> ' . $row['cook_time'] . ' minutes</p>';
                    echo '<p><strong>Diet Type:</strong> ' . $row['diet_type'] . '</p>';
                    echo '<details>';
                    echo '<summary>Ingredients</summary>';
                    echo '<p>' . $row['ingredients'] . '</p>';
                    echo '</details>';
                    echo '<form class="save-to-favorites" data-recipe-id="' . $row['id'] . '">';
                    echo '<button type="button" class="save-favorite-btn">Save to Favorites</button>';
                    echo '</form>';

                    echo '</div>';
                }
            } else {
                echo "<p>No recipes found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- <---------footer---------->

    <div class="about-section" id="about_section">
        <div class="about-content">
            <h2>About CookMate</h2><br>
            <p>CookMate is your ultimate cooking companion! <br>
                Explore unique recipes, save your favorites, <br>
                and share your culinary journey with the world.</p><br>

            <h3>Follow us on :</h3>
            <div class="icons">
                <a href="https://www.facebook.com/" target="_blank"> <i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://web.whatsapp.com/" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://x.com/" target="_blank"><i class="fa-solid fa-x"></i></a>
            </div>
        </div>

        <div class="feedback-section">
            <h3>We Value Your Feedback!</h3>
            <div class="rating">
                <p>Rate your experience:</p>
                <div class="emojis">
                    <span class="emoji" data-rating="1">&#x1F621;</span>
                    <span class="emoji" data-rating="2">&#x1F610;</span>
                    <span class="emoji" data-rating="3">🙂</span>
                    <span class="emoji" data-rating="4">😃</span>
                    <span class="emoji" data-rating="5">🤩</span>
                </div>
            </div>
            <textarea id="feedback" placeholder="Write your feedback here..." rows="4"></textarea>
            <button id="submitFeedback">Submit</button>
            <p id="feedbackMessage" style="display: none; color: green; font-weight: bold;"></p>
        </div>
    </div>


    <div id="footer">
        <div class="copy-right">
            <p>&copy; Copyright @ Vijay. Made with <i class="fa-sharp fa-solid fa-heart"></i> .</p>
        </div>

    </div>

    <!----------javaScript------------>
    <script>

        //   --------------Ajax for filtering-----------

        document.getElementById("applyFilters").addEventListener("click", function () {
            const search = document.getElementById("search").value;
            const cuisine = document.getElementById("cuisine").value;
            const dietType = document.getElementById("diet_type").value;
            const cookTime = document.getElementById("cook_time").value;

            fetch('filter_recipes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ search, cuisine, dietType, cookTime })
            })
                .then(response => response.json())  //converting json to javascript object
                .then(data => {
                    const recipeContainer = document.getElementById("recipeContainer");
                    recipeContainer.innerHTML = ""; // Clear existing recipes

                    if (data.length > 0) {
                        data.forEach(recipe => {
                            recipeContainer.innerHTML += `
                        <div class="recipe-card">
                            <img src="${recipe.image}" alt="${recipe.name}">
                           <h2><a href="recipe_details.php?id=${recipe.id}">${recipe.name}</a></h2>
                            <p><strong>Cuisine:</strong> ${recipe.cuisine}</p>
                            <p><strong>Cook Time:</strong> ${recipe.cook_time} minutes</p>
                            <p><strong>Diet Type:</strong> ${recipe.diet_type}</p>
                            <details>
                                <summary>Ingredients</summary>
                                <p>${recipe.ingredients}</p> 
                            </details>
                            <form action="" method="POST">
                                <input type="hidden" name="recipe_id" value="${recipe.id}">
                                <button type="submit" name="save">Save to Favorites</button>
                            </form>
                        </div>
                    `;
                        });
                    } else {
                        recipeContainer.innerHTML = "<p>No recipes found.</p>";
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        //    ---------Ajax for Adding into favorites-----------

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".save-to-favorites").forEach(function (form) {
                form.addEventListener("click", function (event) {
                    const recipeId = form.getAttribute("data-recipe-id");

                    fetch("save_to_fav.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({ recipe_id: recipeId }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            const messageElement = document.getElementById("fav_Message");
                            if (data.success) {
                                messageElement.textContent = "Recipe saved to favorites!";
                                messageElement.style.display = "block";
                                messageElement.style.color = "green";
                            } else {
                                messageElement.textContent = data.message || "An error occurred.";
                                messageElement.style.display = "block";
                                messageElement.style.color = "red";
                            }
                            setTimeout(() => {
                                messageElement.style.display = "none";
                            }, 5000);
                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });
                });
            });
        });

    </script>

</body>

</html>
<?php
$conn->close();
?>