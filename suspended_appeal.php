<?php
session_start();
require_once 'actions/db_connect.php';

// ✅ Ensure only logged-in users can access
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch user status and suspension reason
$user_stmt = $conn->prepare("SELECT status, suspension_reason FROM users WHERE id = :user_id");
$user_stmt->execute([':user_id' => $user_id]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Check appeal status
$appeal_stmt = $conn->prepare("SELECT * FROM suspension_appeals WHERE user_id = :user_id AND status = 'Pending'");
$appeal_stmt->execute([':user_id' => $user_id]);
$existing_appeal = $appeal_stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Set notification messages
$message = "";
$message_class = "";

if (!$user || ($user['status'] === 'Active' && empty($user['suspension_reason']))) {
    $message = "No new notifications.";
    $message_class = "notification-message";
} elseif ($user['status'] === 'Active' && !empty($user['suspension_reason'])) {
    $message = "Admin has approved your appeal. Your account is now active.";
    $message_class = "notification-approved";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspension Appeal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/suspension.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <header>
        <h1>Cozy Kitchen Delights♡</h1>
    </header>

    <nav class="headnav">
        <div class="navigatebar">
            <a href="registereduser_home.php" class="home-link">
                <i class="fa-solid fa-house"></i>
            </a>
            <a href="user_profile.php" class="profile">
                <i class="fa-solid fa-user"></i>
            </a>
            <a href="user_favorite.php" class="favorite-link">
                <i class="fa-solid fa-heart"></i>
            </a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <?php if (!empty($message)): ?>
        <div class="notification-container">
            <h2 class="<?= $message_class ?>"><?= $message ?></h2>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <h2 class="text-danger text-center">Your Account is Suspended</h2>
            <p class="text-center">Below is the reason for your suspension. If you believe this was a mistake, you can
                submit an appeal.</p>

            <div class="card mt-4">
                <div class="card-body">
                    <h4>Suspension Reason:</h4>
                    <p class="text-danger"><?= htmlspecialchars($user['suspension_reason']); ?></p>
                </div>
            </div>

            <!-- Appeal Form -->
            <?php if ($existing_appeal): ?>
                <div class="alert alert-info mt-4">You have already submitted an appeal. Please wait for admin review.</div>
            <?php else: ?>
                <form action="actions/submit_appeal.php" method="POST" class="mt-4">
                    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                    <div class="mb-3">
                        <label for="appeal_message" class="form-label"><strong>Why should your account be
                                reactivated?</strong></label>
                        <textarea name="appeal_message" id="appeal_message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit Appeal</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>

</html>