<?php
session_start();
include 'actions/db_connect.php';

// Ensure IT support role is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'it_support') {
    header("Location: index.html");
    exit;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=resolved_issues.csv');
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Issue Title', 'Description', 'Priority', 'Status', 'Resolved Date']);

// Fetch resolved issues
try {
    $stmt = $conn->prepare("SELECT issue_title, description, priority, status, updated_at FROM it_issues WHERE status = 'Resolved' ORDER BY updated_at DESC");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row);
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
fclose($output);
?>