<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// ✅ Ensure a user ID is provided
if (!isset($_GET['user']) || empty($_GET['user'])) {
    die("User ID not specified.");
}

$user_id = $_GET['user'];

$stmt = $conn->prepare("SELECT id, username, profile_picture, bio, facebook, twitter, instagram FROM users WHERE id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

// ✅ Default profile picture if none uploaded
$profile_picture = !empty($user['profile_picture']) ? $user['profile_picture'] : "uploads/default.png";

// ✅ Fetch recipes posted by the user
$recipes_stmt = $conn->prepare("
    SELECT r.id, r.recipeName, r.recipeImage, r.description 
    FROM recipe r
    WHERE r.user_id = :user_id
");
$recipes_stmt->execute([':user_id' => $user_id]);
$recipes = $recipes_stmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ Determine "Back to Home" link based on session
$home_link = isset($_SESSION['user_id']) ? 'registereduser_home.php' : 'index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($user['username']); ?>'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/user_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <div class="container mt-5">
        <!-- Dynamic Back to Home Button -->
        <a href="<?= $home_link; ?>" class="btn btn-secondary mb-3">Back to Home</a>

        <div class="card user-card">
            <div class="card-body d-flex align-items-center">
                <div class="user-image">
                    <img src="<?= htmlspecialchars($profile_picture); ?>" alt="Profile Picture"
                        class="rounded-circle user-pic">
                </div>
                <div class="user-info">
                    <h3 class="mt-3"><?= htmlspecialchars($user['username']); ?></h3>
                    <p class="bio-text"><?= nl2br(htmlspecialchars($user['bio'] ?? "No bio available.")); ?></p>

                    <!-- ✅ Social media links inside user-info to appear below bio -->
                    <div class="social-media-links d-flex mt-2">
                        <?php if (!empty($user['facebook']) && filter_var($user['facebook'], FILTER_VALIDATE_URL)): ?>
                            <a href="<?= htmlspecialchars($user['facebook']); ?>" target="_blank" class="me-2">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($user['twitter']) && filter_var($user['twitter'], FILTER_VALIDATE_URL)): ?>
                            <a href="<?= htmlspecialchars($user['twitter']); ?>" target="_blank" class="me-2">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($user['instagram']) && filter_var($user['instagram'], FILTER_VALIDATE_URL)): ?>
                            <a href="<?= htmlspecialchars($user['instagram']); ?>" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Recipes Posted by User -->
        <h2 class="mt-5 text-center charm-bold">Recipes by <?= htmlspecialchars($user['username']); ?></h2>
        <div class="row">
            <?php if (empty($recipes)): ?>
                <p class="text-center">No recipes posted yet.</p>
            <?php else: ?>
                <?php foreach ($recipes as $recipe): ?>
                    <div class="col-md-4">
                        <div class="card recipe-card">
                            <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>" class="card-img-top"
                                alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($recipe['recipeName']); ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars($recipe['description'])); ?></p>
                                <a href="recipe_details.php?id=<?= $recipe['id']; ?>" class="btn btn-primary">View Recipe</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>