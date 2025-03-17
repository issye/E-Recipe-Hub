<?php
session_start();
include 'db_connect.php'; // Ensure correct database connection

// ✅ Ensure only the admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.html");
    exit;
}

// ✅ Ensure user ID and status are provided
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Invalid request.");
}

$user_id = $_GET['id'];
$new_status = $_GET['status'];
$suspension_reason = isset($_GET['reason']) ? $_GET['reason'] : null;

if ($new_status === 'Suspended' && !$suspension_reason) {
    die("Suspension reason is required.");
}

// ✅ Update user status in the database
$update_stmt = $conn->prepare("UPDATE users SET status = :status, suspension_reason = :reason WHERE id = :user_id");
$update_stmt->execute([
    ':status' => $new_status,
    ':reason' => $suspension_reason,
    ':user_id' => $user_id
]);

// ✅ Redirect back to user management page
header("Location: ../View_User.php");
exit;
?>
