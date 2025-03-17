<?php
session_start();
header('Content-Type: application/json');

// Database connection
require_once 'actions/db_connect.php';

if (!isset($_GET['recipe_id'])) {
    echo json_encode(['success' => false, 'message' => 'Recipe ID missing']);
    exit;
}

$recipe_id = $_GET['recipe_id'];
$user_id = $_SESSION['user_id'];

// Fetch the user's previous rating
$query = "SELECT rating FROM ratings WHERE recipe_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$recipe_id, $user_id]);
$user_rating = $stmt->fetchColumn();

// Fetch the overall average rating
$query = "SELECT AVG(rating) as avg_rating FROM ratings WHERE recipe_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$recipe_id]);
$avg_rating = $stmt->fetchColumn();

echo json_encode([
    'success' => true,
    'user_rating' => $user_rating ?? 0,
    'overall_rating' => round($avg_rating, 1)
]);
