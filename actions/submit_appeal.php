<?php
session_start();
require_once 'db_connect.php';

// ✅ Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit;
}

// ✅ Ensure form data is provided
if (!isset($_POST['user_id'], $_POST['appeal_message'])) {
    die("Invalid request.");
}

$user_id = $_POST['user_id'];
$appeal_message = trim($_POST['appeal_message']);

// ✅ Check if the user is suspended
$user_stmt = $conn->prepare("SELECT status, suspension_reason FROM users WHERE id = :user_id");
$user_stmt->execute([':user_id' => $user_id]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

if ($user['status'] !== 'Suspended') {
    die("You are not suspended.");
}

// ✅ Insert appeal into the database
$appeal_stmt = $conn->prepare("INSERT INTO suspension_appeals (user_id, suspension_reason, appeal_message) VALUES (:user_id, :suspension_reason, :appeal_message)");
$appeal_stmt->execute([
    ':user_id' => $user_id,
    ':suspension_reason' => $user['suspension_reason'],
    ':appeal_message' => $appeal_message
]);

// ✅ Redirect after submission
header("Location: ../suspended_appeal.php?success=1");
exit;
?>
