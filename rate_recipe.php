<?php
session_start();
header('Content-Type: application/json');

// Database connection
require_once 'actions/db_connect.php';

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Validate data
if (!isset($data['recipe_id']) || !isset($data['rating']) || !is_numeric($data['rating'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$recipe_id = $data['recipe_id'];
$rating = $data['rating'];
$user_id = $_SESSION['user_id'];

// Insert or update the rating in the database
$query = "INSERT INTO ratings (recipe_id, user_id, rating) 
          VALUES (?, ?, ?) 
          ON DUPLICATE KEY UPDATE rating = VALUES(rating)";
$stmt = $conn->prepare($query);
$stmt->execute([$recipe_id, $user_id, $rating]);

// Calculate the new average rating
$query = "SELECT AVG(rating) as avg_rating FROM ratings WHERE recipe_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$recipe_id]);
$avg_rating = $stmt->fetch(PDO::FETCH_ASSOC)['avg_rating'];

// Return the new average rating
echo json_encode(['success' => true, 'new_rating' => round($avg_rating, 1)]);
