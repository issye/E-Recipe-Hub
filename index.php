<?php
session_start();

// Include database connection
include 'actions/db_connect.php';

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

$randomRecipesQuery = "SELECT id, recipeName, description, recipeImage FROM recipe 
WHERE id NOT IN (" . implode(',', $selected_recipe_ids) . ") 
ORDER BY RAND() LIMIT 3"; // Fetch 6 random recipes

$randomStmt = $conn->prepare($randomRecipesQuery);
$randomStmt->execute();
$randomRecipes = $randomStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Kitchen Delights♡</title>

    <!-- ✅ Kept Your Styling -->
    <link rel="stylesheet" type="text/css" href="css/Home.css">
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

    <!-- ✅ Header -->
    <header>
        <h1>
            <a href="index.php" class="header-link">Cozy Kitchen Delights♡</a>
        </h1>
        <div class="search-container">
            <button class="search-button" onclick="toggleSearchModal()">
                <i class="fa fa-search"></i> Search
            </button>
        </div>
    </header>

    <!-- ✅ Navbar -->
    <div class="navbar">
        <a href="AllRecipe.php">All Recipes</a>
        <a href="javascript:void(0);" onclick="toggleLoginPopup()">Log In / Sign Up</a>
    </div>

    <!-- ✅ Search Modal -->
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

    <!-- ✅ Login Popup -->
    <div id="loginPopup" class="popup-container">
        <div class="popup">
            <span class="close-btn" onclick="closeLoginPopup()">&times;</span>
            <h2>Log In</h2>

            <!-- ✅ Login Error Message Inside Modal -->
            <div id="loginError" class="alert alert-danger text-center" style="display: none;">
                <span id="errorMessage"></span>
            </div>

            <!-- ✅ Login Form -->
            <form action="actions/login.php" method="POST">
                <div class="row">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="row">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="button">
                    <input type="submit" value="Log In">
                </div>
                <div class="signup-link">
                    Don't have an account? <a href="signup.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ JavaScript -->
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
                body: `query=${encodeURIComponent(searchQuery)}&category=${encodeURIComponent(category)}`
            })
                .then(response => response.json())
                .then(data => {
                    let recipesContainer = document.querySelector('.items');
                    recipesContainer.innerHTML = ''; // Clear previous results

                    if (!data || data.length === 0) {
                        recipesContainer.innerHTML = '<p>No recipes found.</p>';
                        return;
                    }

                    data.forEach(recipe => {
                        let recipeItem = `
                <div class="item" onclick="window.location.href='recipe_details.php?id=${recipe.id}'">
                    <h4>${recipe.recipeName}</h4>
                    <img src="${recipe.recipeImage}" alt="${recipe.recipeName}">
                    <button>${recipe.description}</button>
                </div>
            `;
                        recipesContainer.innerHTML += recipeItem;
                    });
                })
                .catch(error => console.error('Error:', error));
        }


        // ✅ Toggle Login Popup
        function toggleLoginPopup() {
            document.getElementById('loginPopup').style.display = 'flex';
        }

        function closeLoginPopup() {
            document.getElementById('loginPopup').style.display = 'none';
        }

        // ✅ Show Login Popup Automatically if Login Fails
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('login')) {
                toggleLoginPopup(); // Open the login modal

                // Set error message
                let errorMsg = "Incorrect username or password.";
                if (urlParams.get('login') === 'failed' && urlParams.has('attempts')) {
                    let attemptsLeft = 5 - urlParams.get('attempts');
                    errorMsg += ` You have ${attemptsLeft} attempts left before lockout.`;
                } else if (urlParams.get('login') === 'locked' && urlParams.has('time')) {
                    errorMsg = `Your account is locked. Try again in ${urlParams.get('time')} minutes.`;
                }

                document.getElementById('errorMessage').innerText = errorMsg;
                document.getElementById('loginError').style.display = 'block';
            }
        });
    </script>

</body>

</html>