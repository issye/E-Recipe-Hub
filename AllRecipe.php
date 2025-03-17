<?php
// Include the database connection file
include 'actions/db_connect.php';

// Fetch all recipes from the database
$query = "SELECT id, recipeName, description, recipeImage FROM recipe";
$stmt = $conn->prepare($query);
$stmt->execute();

// Initialize an array to store recipes
$recipes = [];

if ($stmt->rowCount() > 0) {
    // Fetch all rows as an associative array
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Kitchen Delights - All Recipes</title>
    <link rel="stylesheet" type="text/css" href="css/AllRecipe.css">
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
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Cozy Kitchen Delights♡</h1>
        <button class="search-button" onclick="toggleSearchModal()">
            <i class="fa fa-search"></i>
        </button>
    </header>

    <nav class="headnav">
        <div class="navigatebar">
            <a href="index.php" class="home-link">
                <i class="fa-solid fa-house"></i>
            </a>
            <a href="javascript:void(0);" onclick="toggleLoginPopup()">Log In / Sign Up</a>
           
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
    </nav>
    
    <h5>All Recipes</h5>

    <section class="items">
        <!-- Real Recipes from Database -->
        <?php foreach ($recipes as $recipe): ?>
            <div class="item" onclick="window.location.href='recipe_details.php?id=<?= urlencode($recipe['id']); ?>'">
                <h4><?= htmlspecialchars($recipe['recipeName']); ?></h4>
                <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>" alt="<?= htmlspecialchars($recipe['recipeName']); ?>">
                <button><?= htmlspecialchars($recipe['description']); ?></button>
            </div>
        <?php endforeach; ?>
    </section>

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
    <footer>
        <p>&copy; 2025 Cozy Kitchen Delights</p>
    </footer>

</body>

</html>
