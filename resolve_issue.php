<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Ensure IT support role is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'it_support') {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['issue_id'])) {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE it_issues SET status = 'Resolved', updated_at = NOW() WHERE id = :issue_id");
    $stmt->execute([':issue_id' => $data['issue_id']]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>