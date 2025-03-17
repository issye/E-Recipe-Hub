<?php
session_start();
include 'db_connect.php'; // No need for '../' since it is in the same folder

// Ensure only admin can delete users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.html");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);

    header("Location: ../View_User.php");
    exit;
}
?>
