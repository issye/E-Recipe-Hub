<?php
session_start();
include 'actions/db_connect.php';
// ✅ Log the logout action before destroying session
$logStmt = $conn->prepare("INSERT INTO activity_logs (user, action, status) VALUES (:user, 'Logged Out', 'Logout')");
$logStmt->execute([':user' => $_SESSION['username']]);
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>