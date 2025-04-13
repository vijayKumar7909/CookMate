<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "cookmate");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$data = json_decode(file_get_contents('php://input'), true);
$search = $data['search'] ?? '';
$cuisine = $data['cuisine'] ?? '';
$dietType = $data['dietType'] ?? '';
$cookTime = $data['cookTime'] ?? 0;

$sql = "SELECT * FROM recipes WHERE 1=1";
if ($search) $sql .= " AND name LIKE '%$search%'";
if ($cuisine) $sql .= " AND cuisine = '$cuisine'";
if ($dietType) $sql .= " AND diet_type = '$dietType'";
if ($cookTime) $sql .= " AND cook_time <= $cookTime";

$result = $conn->query($sql);

$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

echo json_encode($recipes);
$conn->close();
