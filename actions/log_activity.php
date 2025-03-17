<?php
include 'db_connect.php';

function logActivity($user, $action, $status = 'Success') {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO activity_logs (user, action, status) VALUES (:user, :action, :status)");
    $stmt->execute([
        ':user' => $user,
        ':action' => $action,
        ':status' => $status
    ]);
}
?>
