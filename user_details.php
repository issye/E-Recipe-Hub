<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// ✅ Check if `id` is set and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-5 text-center'><h3 class='text-danger'>Error: User ID not specified or invalid.</h3>
          <a href='admin.php' class='btn btn-secondary mt-3'>Back to Admin Panel</a></div>";
    exit;
}

$user_id = intval($_GET['id']); // Convert to integer for safety

// ✅ Fetch user details safely
$stmt = $conn->prepare("SELECT id, username, email, phone_number, address, gender, profile_picture, created_at 
                        FROM users WHERE id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div class='container mt-5 text-center'><h3 class='text-danger'>Error: User not found.</h3>
          <a href='View_User.php' class='btn btn-secondary mt-3'>Back to Admin Panel</a></div>";
    exit;
}

// ✅ Default profile picture if none uploaded
$profile_picture = !empty($user['profile_picture']) ? $user['profile_picture'] : "uploads/default.png";

// ✅ Fetch recipes posted by the user
$recipes_stmt = $conn->prepare("
    SELECT r.id, r.recipeName, r.recipeImage, 
           IFNULL(AVG(rt.rating), 'No ratings yet') AS avg_rating, 
           COUNT(rt.rating) AS total_reviews
    FROM recipe r
    LEFT JOIN ratings rt ON r.id = rt.recipe_id
    WHERE r.user_id = :user_id
    GROUP BY r.id
");
$recipes_stmt->execute([':user_id' => $user_id]);
$recipes = $recipes_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="container mt-5">
        <a href="View_User.php" class="btn btn-secondary mb-3">Back to Admin Panel</a>

        <div class="card user-card">
            <div class="card-body d-flex align-items-center">
                <div class="user-image">
                    <img src="<?= htmlspecialchars($profile_picture); ?>" alt="Profile Picture"
                        class="rounded-circle user-pic">
                </div>
                <div class="user-info">
                    <h3><?= htmlspecialchars($user['username']); ?></h3>
                    <p class="user-id"><strong>User ID:</strong> <?= htmlspecialchars($user['id']); ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone_number']); ?></p>
                    <p><strong>Address:</strong>
                        <?= !empty($user['address']) ? htmlspecialchars($user['address']) : "Not Provided"; ?></p>
                    <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']); ?></p>
                    <p><strong>Account Created:</strong> <?= htmlspecialchars($user['created_at']); ?></p>
                </div>
            </div>
        </div>

        <!-- Recipes Posted by User -->
        <h2 class="mt-5 text-center">Recipes Posted by <?= htmlspecialchars($user['username']); ?></h2>
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
                                <p class="card-text">
                                    <strong>Rating:</strong>
                                    <?= is_numeric($recipe['avg_rating']) ? round($recipe['avg_rating'], 1) . "/5" : $recipe['avg_rating']; ?>
                                    (<?= $recipe['total_reviews']; ?> reviews)
                                </p>
                                <a href="recipe_details.php?id=<?= urlencode($recipe['id']); ?>" class="btn btn-primary">View
                                    Recipe</a>
                                <button class="btn btn-danger" onclick="confirmDelete(<?= $recipe['id']; ?>)">Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function confirmDelete(recipeId) {
            if (confirm("Are you sure you want to delete this recipe?")) {
                window.location.href = "delete_recipe.php?id=" + recipeId;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>