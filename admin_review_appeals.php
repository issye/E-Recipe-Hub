<?php
session_start();
require_once 'actions/db_connect.php';

// ✅ Ensure only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit;
}

// ✅ Fetch all pending appeals
$appeals_stmt = $conn->prepare("SELECT sa.*, u.username, u.email FROM suspension_appeals sa JOIN users u ON sa.user_id = u.id WHERE sa.status = 'Pending'");
$appeals_stmt->execute();
$appeals = $appeals_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Review Appeals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Suspension Appeals</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Suspension Reason</th>
                    <th>Appeal Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appeals as $appeal): ?>
                    <tr>
                        <td><?= htmlspecialchars($appeal['username']); ?></td>
                        <td><?= htmlspecialchars($appeal['email']); ?></td>
                        <td class="text-danger"><?= htmlspecialchars($appeal['suspension_reason']); ?></td>
                        <td><?= htmlspecialchars($appeal['appeal_message']); ?></td>
                        <td>
                            <a href="actions/reactivate_user.php?id=<?= $appeal['user_id']; ?>" class="btn btn-success">Reactivate</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
