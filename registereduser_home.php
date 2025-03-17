<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

// Database connection
require_once 'actions/db_connect.php';

// ✅ Fetch user status (Check if the account is suspended)
$user_status = 'Active'; // Default
if (isset($_SESSION['user_id'])) {
    $user_stmt = $conn->prepare("SELECT status FROM users WHERE id = :user_id");
    $user_stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
    $user_status = $user['status'] ?? 'Active';
}

// ✅ Fetch recipes from the database
// Select 4 specific recipes by their IDs
$selected_recipe_ids = [13, 14, 20, 21, 23, 24];
$query = "SELECT id, recipeName, description, recipeImage FROM recipe WHERE id IN (" . implode(',', $selected_recipe_ids) . ")";
$stmt = $conn->prepare($query);
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selected_user_ids = [5, 11, 12, 7, 1, 13]; // Change these IDs to the users you want to display
$userQuery = "SELECT id, username, profile_picture FROM users WHERE id IN (" . implode(',', $selected_user_ids) . ")";
$userStmt = $conn->prepare($userQuery);
$userStmt->execute();
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ Fetch 3 random recipes that are NOT in the featured list
$randomRecipesQuery = "SELECT id, recipeName, description, recipeImage FROM recipe 
WHERE id NOT IN (" . implode(',', $selected_recipe_ids) . ") 
ORDER BY RAND() LIMIT 3"; // Fetch 6 random recipes

$randomStmt = $conn->prepare($randomRecipesQuery);
$randomStmt->execute();
$randomRecipes = $randomStmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Kitchen Delights♡</title>
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
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
</head>


<body>
<header>
    <h1>
        <a href="registereduser_home.php" class="header-link">Cozy Kitchen Delights♡</a>
    </h1>
    <div class="search-container">
        <div class="profile-container">
            <button class="profile-button" onclick="window.location.href='User_profile.php'">
                <i class="fa fa-user"></i>
            </button>
            <span class="username-display"><?= htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <button class="search-button" onclick="toggleSearchModal()">
            <i class="fa fa-search"></i>
        </button>
    </div>
</header>


    <div class="navbar">
        <a href="allRecipeUser.php">All Recipes</a>
        <a href="user_profile.php" class="profile">
            <i class="fa-solid fa-user"></i>
        </a>
        <a href="NewRecipe.php" class="create-post-button">
            <i class="fa fa-plus"></i>
        </a>

        <!-- 🔔 Notification Icon -->
        <a href="suspended_appeal.php" class="notification-link">
            <i class="fa-solid fa-bell"></i>
            <?php if ($user_status === 'Suspended'): ?>
                <span class="notification-badge"></span> <!-- Red dot for notification -->
            <?php endif; ?>
        </a>

        <!-- ❤️ Favorites Icon -->
        <a href="user_favorite.php" class="favorite-link">
            <i class="fa-solid fa-heart"></i>
        </a>


        <a href="logout.php">Logout</a>
    </div>

    <div id="searchModal" class="search-modal">
        <div class="search-modal-content">
            <span class="close-btn" onclick="toggleSearchModal()">&times;</span>
            <h2>Search Recipes</h2>
            <input type="text" id="searchInput" placeholder="Search for recipes...">
            <select id="categorySelect">
    <option value="">Select Category</option>
    <option value="Desserts">Desserts</option>
    <option value="Pastries">Pastries</option>
    <option value="Snacks">Snacks</option>
    <option value="Malay Cuisine">Malay Cuisine</option>
    <option value="Western">Western</option>
    <option value="Breakfast">Breakfast</option>
    <option value="Chinese Cuisine">Chinese Cuisine</option>
    <option value="Indian Cuisine">Indian Cuisine</option>
    <option value="Main Course">Main Course</option>
</select>

            <button class="search-button" onclick="performSearch()">Search</button>


        </div>
    </div>

    <section class="items">
        <?php foreach ($recipes as $recipe): ?>
            <div class="item">

                <h4><?= htmlspecialchars($recipe['recipeName']); ?></h4>
                <a href="recipe_details.php?id=<?= urlencode($recipe['id']); ?>" class="view-details">
                    <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>"
                        alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
                </a>
                <button><?= htmlspecialchars($recipe['description']); ?></button>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Section for Featured Users -->
    <section class="users-section">
        <div class="white-box">
            <h2>MALAYSIAN PRIDE: CULINARY EXCELLENCE</h2>
            <p class="section-description">
                These chefs are recognized for their mastery of Malaysian flavors, innovative techniques, and dedication
                to preserving and redefining the nation’s culinary heritage.
                Their contributions showcase Malaysia’s diverse food culture, blending tradition with creativity
                to leave a lasting impact locally and globally.
            </p>
            <div class="user-container">
                <?php foreach ($users as $user): ?>
                    <div class="user">
                        <a href="user_page.php?user=<?= urlencode($user['id']); ?>" class="profile-link">
                            <img src="<?= htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
                        </a>
                        <p><?= htmlspecialchars($user['username']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <h2 class="centered-title">NEW & TRENDING RECIPES</h2>
    <!-- Section for New & Trending Recipes -->
    <section class="items">
        <!-- ✅ Title first -->
        <?php foreach ($randomRecipes as $recipe): ?>
            <div class="item">
                <h4><?= htmlspecialchars($recipe['recipeName']); ?></h4>
                <a href="recipe_details.php?id=<?= urlencode($recipe['id']); ?>" class="view-details">
                    <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>"
                        alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
                </a>
                <button><?= htmlspecialchars($recipe['description']); ?></button>
            </div>
        <?php endforeach; ?>
    </section>



    <script>
        function toggleSearchModal() {
            const modal = document.getElementById('searchModal');
            modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
        }

        function performSearch() {
            let searchQuery = document.getElementById('searchInput').value.trim();
            let category = document.getElementById('categorySelect').value.trim();

            fetch('search_recipes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'query=' + encodeURIComponent(searchQuery) + '&category=' + encodeURIComponent(category)
            })
                .then(response => response.json())
                .then(data => {
                    let recipesContainer = document.querySelector('.items');
                    recipesContainer.innerHTML = ''; // Clear previous results

                    if (data.length === 0) {
                        recipesContainer.innerHTML = '<p>No recipes found.</p>';
                        return;
                    }

                    data.forEach(recipe => {
                        let recipeItem = `
                <div class="item">
                    <h4>${recipe.recipeName}</h4>
                    <a href="recipe_details.php?id=${recipe.id}" class="view-details">
                        <img src="${recipe.recipeImage}" alt="${recipe.recipeName}">
                    </a>
                    <button>${recipe.description}</button>
                </div>
            `;
                        recipesContainer.innerHTML += recipeItem;
                    });
                })
                .catch(error => console.error('Error:', error));
        }



    </script>
</body>

</html>