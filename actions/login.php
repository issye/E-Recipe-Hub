<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // ✅ Fetch user from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ✅ Check if the user exists
    if ($user) {
        // ✅ Check if account is locked due to multiple failed attempts
        if ($user['failed_attempts'] >= 5 && strtotime($user['lockout_time']) > time()) {
            $remaining_time = ceil((strtotime($user['lockout_time']) - time()) / 60);
            header("Location: ../index.php?login=locked&time=$remaining_time");
            exit;
        }

        // ✅ Verify password
        if (password_verify($password, $user['password'])) {
            // ✅ Reset failed attempts after successful login
            $resetStmt = $conn->prepare("UPDATE users SET failed_attempts = 0, lockout_time = NULL WHERE id = :id");
            $resetStmt->execute([':id' => $user['id']]);

            // ✅ Store session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            // ✅ Log successful login
            $logStmt = $conn->prepare("INSERT INTO activity_logs (user, action, status) VALUES (:user, 'Logged In', 'Success')");
            $logStmt->execute([':user' => $username]);

            // ✅ Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header("Location: ../admin.php");
                    break;
                case 'it_support':
                    header("Location: ../itsupport_home.php");
                    break;
                default:
                    header("Location: ../registereduser_home.php");
            }
            exit;
        } else {
            // ✅ Increase failed attempts count
            $failed_attempts = $user['failed_attempts'] + 1;
            $lockout_time = ($failed_attempts >= 5) ? date('Y-m-d H:i:s', strtotime('+10 minutes')) : NULL;

            $updateStmt = $conn->prepare("UPDATE users SET failed_attempts = :attempts, lockout_time = :lockout WHERE id = :id");
            $updateStmt->execute([':attempts' => $failed_attempts, ':lockout' => $lockout_time, ':id' => $user['id']]);

            // ✅ Log failed login attempt
            $logStmt = $conn->prepare("INSERT INTO activity_logs (user, action, status) VALUES (:user, 'Login Attempt', 'Failed')");
            $logStmt->execute([':user' => $username]);

            // ✅ Redirect with failure message
            header("Location: ../index.php?login=failed&attempts=$failed_attempts");
            exit;
        }
    } else {
        // ✅ Log failed login attempt for non-existent user
        $logStmt = $conn->prepare("INSERT INTO activity_logs (user, action, status) VALUES (:user, 'Login Attempt', 'Failed')");
        $logStmt->execute([':user' => $username]);

        header("Location: ../index.php?login=failed");
        exit;
    }
}
?>
