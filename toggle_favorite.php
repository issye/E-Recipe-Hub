<?php
session_start();
require_once 'actions/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_POST['recipe_id'] ?? null;

if (!$recipe_id) {
    echo json_encode(["status" => "error", "message" => "Recipe ID is missing."]);
    exit();
}

// Check if the recipe is already in favorites
$query = "SELECT * FROM favorites WHERE user_id = ? AND recipe_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$user_id, $recipe_id]);
$favorite = $stmt->fetch(PDO::FETCH_ASSOC);

if ($favorite) {
    // If exists, remove from favorites
    $deleteQuery = "DELETE FROM favorites WHERE user_id = ? AND recipe_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->execute([$user_id, $recipe_id]);
    echo json_encode(["status" => "removed"]);
} else {
    // If not exists, add to favorites
    $insertQuery = "INSERT INTO favorites (user_id, recipe_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->execute([$user_id, $recipe_id]);
    echo json_encode(["status" => "added"]);
}

exit();
?>