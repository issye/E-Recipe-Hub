<?php
// Start session
session_start();

// Include database connection
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    // ✅ Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: ../signup.php?signup=failed&error=password_mismatch");
        exit();
    }

    // ✅ Check if username or email already exists
    $checkStmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $checkStmt->execute([':username' => $username, ':email' => $email]);
    if ($checkStmt->rowCount() > 0) {
        header("Location: ../signup.php?signup=failed&error=user_exists");
        exit();
    }

    // ✅ Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, phone_number, password, gender) 
                            VALUES (:full_name, :username, :email, :phone_number, :password, :gender)");
    $stmt->execute([
        ':full_name' => $full_name,
        ':username' => $username,
        ':email' => $email,
        ':phone_number' => $phone_number,
        ':password' => $hashed_password,
        ':gender' => $gender
    ]);

    // ✅ Redirect to signup page with success message
    header("Location: ../signup.php?signup=success");
    exit();
}
?>
