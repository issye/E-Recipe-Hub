<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Ensure IT support role is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'it_support') {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

try {
    // Retrieve all resolved issues
    $stmt = $conn->prepare("SELECT id, issue_title, description, priority, status, updated_at FROM it_issues WHERE status IN ('Updated', 'Resolved', 'Logged Out')");
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return logs as JSON
    echo json_encode($logs);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>