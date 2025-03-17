<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection is included

// Check if a user ID is passed
if (!isset($_GET['user'])) {
    die("User ID not provided.");
}

$postedby_id = $_GET['user'];

// Fetch user details
$user_stmt = $conn->prepare("SELECT id, username FROM users WHERE id = :user_id");
$user_stmt->execute([':user_id' => $postedby_id]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

// If user not found, show error
if (!$user) {
    die("User not found.");
}

// Fetch all recipes posted by this user
$recipe_stmt = $conn->prepare("SELECT id, recipeName, recipeImage, category FROM recipe WHERE user_id = :user_id");
$recipe_stmt->execute([':user_id' => $postedby_id]);
$recipes = $recipe_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($user['username']); ?>'s Profile</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/postedby_profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rouge+Script&family=Vidaloka&family=Oranienbaum&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="profile-card">
        <h1 class="profile-title"><?= htmlspecialchars($user['username']); ?>'s Profile</h1>

        <h2 class="profile-subtitle">Recipes Posted</h2>
        <?php if (count($recipes) > 0): ?>
            <div class="recipe-grid">
                <?php foreach ($recipes as $recipe): ?>
                    <div class="recipe-card">
                        <a href="recipe_details.php?id=<?= urlencode($recipe['id']); ?>">
                            <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>"
                                alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
                            <h3 class="recipe-name"><?= htmlspecialchars($recipe['recipeName']); ?></h3>
                            <p class="recipe-category"><?= htmlspecialchars($recipe['category']); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-recipes">This user has not posted any recipes yet.</p>
        <?php endif; ?>

        <a href="registereduser_home.php" class="back-button"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
    </div>

</body>

</html>