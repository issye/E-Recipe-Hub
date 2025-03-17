<?php
session_start(); // Keep session start, but no redirect for non-logged users

// Database connection
require_once 'actions/db_connect.php';

// Check if the recipe ID is passed
if (!isset($_GET['id'])) {
    die("Recipe ID not provided.");
}

$recipe_id = $_GET['id'];

// Fetch the recipe details from the database
$query = "SELECT r.recipeName, r.ingredients, r.instructions, r.recipeImage, r.category, 
                 u.username AS posted_by, u.id AS user_id
          FROM recipe r
          JOIN users u ON r.user_id = u.id
          WHERE r.id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$recipe_id]);

$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    die("Recipe not found.");
}

// Check if the user is logged in and fetch their status
$user_status = 'Active'; // Default to Active for non-logged-in users
if (isset($_SESSION['user_id'])) {
    $user_stmt = $conn->prepare("SELECT status FROM users WHERE id = :user_id");
    $user_stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
    $user_status = $user['status'] ?? 'Active'; // Set status if user exists
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recipe['recipeName']); ?></title>
    <link rel="stylesheet" type="text/css" href="css/recipe_card.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rouge+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oranienbaum&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Share Button in Top Right -->
    <div class="share-button" onclick="copyRecipeLink()">
        <i class="fa-solid fa-share-nodes"></i>
    </div>

    <!-- Hidden Input to Store Recipe Link -->
    <input type="text" id="recipe-link" value="" readonly style="position: absolute; left: -9999px;">

    <div class="recipe-card">
        <!-- Recipe Title -->
        <h1 class="recipe-title"><?= htmlspecialchars($recipe['recipeName']); ?></h1>
        <p class="posted-by">
            Posted by
            <a href="<?php echo (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe['user_id'])
                ? 'user_profile.php'
                : 'user_page.php?user=' . urlencode($recipe['user_id']); ?>" class="user-profile-link">
                <?= htmlspecialchars($recipe['posted_by']); ?>
            </a>
        </p>

        <!-- Save to Favorites -->

        <?php
        $favoriteQuery = "SELECT * FROM favorites WHERE user_id = ? AND recipe_id = ?";
        $favoriteStmt = $conn->prepare($favoriteQuery);
        $favoriteStmt->execute([$_SESSION['user_id'] ?? null, $recipe_id]);
        $isFavorite = $favoriteStmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="favorite-container">
            <button class="favorite-btn" onclick="toggleFavorite(<?= htmlspecialchars($recipe_id); ?>)">
                <i id="favorite-icon" class="<?= $isFavorite ? 'fa-solid fa-heart' : 'fa-regular fa-heart'; ?>"></i>
                <span id="favorite-text"><?= $isFavorite ? 'Saved' : 'Save the recipe'; ?></span>
            </button>
        </div>



        <!-- Recipe Image -->
        <div class="recipe-image">
            <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>"
                alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
        </div>

        <!-- Ingredients and Instructions -->
        <div class="details">
            <!-- Ingredients Section with Checkboxes -->
            <div class="ingredients">
                <h2 class="vidaloka-regular">Ingredients</h2>
                <ul class="ingredients-list">
                    <?php foreach (explode("\n", $recipe['ingredients']) as $ingredient): ?>
                        <li>
                            <label class="checkbox-container">
                                <input type="checkbox" class="ingredient-checkbox">
                                <span class="checkmark"></span>
                                <span class="ingredient-text"><?= htmlspecialchars($ingredient); ?></span>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="instructions">
                <h2 class="vidaloka-regular">Cooking Instructions</h2>
                <div class="instructions-list">
                    <?php foreach (explode("\n", $recipe['instructions']) as $instruction): ?>
                        <p class="instruction-text"><?= htmlspecialchars($instruction); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Rating & Review Section (Only for Active Users) -->
        <?php if (isset($_SESSION['username']) && $user_status === 'Active'): ?>
            <div class="rating-container">
                <div class="rating">
                    <h2>Rate the recipe</h2>
                    <div class="stars" id="rating-stars" data-recipe-id="<?= htmlspecialchars($recipe_id); ?>">
                        <i class="fa fa-star" data-value="1"></i>
                        <i class="fa fa-star" data-value="2"></i>
                        <i class="fa fa-star" data-value="3"></i>
                        <i class="fa fa-star" data-value="4"></i>
                        <i class="fa fa-star" data-value="5"></i>
                    </div>
                    <p id="rating-text">Overall rating: <span id="overall-rating">4.5</span>/5</p>
                </div>
            </div>
        <?php elseif (isset($_SESSION['username']) && $user_status === 'Suspended'): ?>
            <p class="text-danger text-center"><strong>Your account is suspended. You cannot rate or review
                    recipes.</strong></p>
        <?php else: ?>
            <p style="text-align: center;"><strong>Log in to rate and review this recipe.</strong></p>
        <?php endif; ?>

    </div>

    <!-- Link External JavaScript File -->
    <script src="js/rating.js"></script>
    <script src="js/favorites.js"></script>

</body>

</html>