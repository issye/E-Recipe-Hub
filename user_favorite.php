<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

require_once 'actions/db_connect.php';

$user_id = $_SESSION['user_id'];

// Fetch user's favorite recipes
$query = "SELECT r.id, r.recipeName, r.recipeImage, r.description 
          FROM favorites f 
          JOIN recipe r ON f.recipe_id = r.id 
          WHERE f.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$user_id]);
$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorite Recipes</title>
    <link rel="stylesheet" type="text/css" href="css/Home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pochaevsk&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet">

</head>

<body>
    <header>
        <h1>Cozy Kitchen Delights♡</h1>
    </header>

    <div class="navbar">
        <a href="registereduser_home.php" class="home-link">
            <i class="fa-solid fa-house"></i>
        </a>
        <a href="allRecipeUser.php">All Recipes</a>
        <a href="user_profile.php" class="profile">
            <i class="fa-solid fa-user"></i>
        </a>
        <a href="NewRecipe.php" class="create-post-button">
            <i class="fa fa-plus"></i>
        </a>



        <a href="logout.php">Logout</a>
    </div>

    <h5>Favorites</h5>

    <section class="items">
        <?php if (count($favorites) > 0): ?>
            <?php foreach ($favorites as $recipe): ?>
                <div class="item">
                    <h4><?= htmlspecialchars($recipe['recipeName']); ?></h4>
                    <a href="recipe_details.php?id=<?= urlencode($recipe['id']); ?>">
                        <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>"
                            alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
                    </a>
                    <button><?= htmlspecialchars($recipe['description']); ?></button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">No favorite recipes yet. Start saving your favorites!</p>
        <?php endif; ?>
    </section>

</body>

</html>