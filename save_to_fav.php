<?php
session_start();
include "config.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($_SESSION['user_id']) || !isset($input['recipe_id'])) {
        echo json_encode(["success" => false, "message" => "Invalid request."]);
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $recipe_id = $conn->real_escape_string($input['recipe_id']);

    $sql = "INSERT INTO user_favorites (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Recipe saved to favorites!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>
