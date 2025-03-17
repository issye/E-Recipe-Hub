<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// ✅ Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// ✅ Fetch user status
$user_stmt = $conn->prepare("SELECT status FROM users WHERE id = :user_id");
$user_stmt->execute([':user_id' => $_SESSION['user_id']]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Restrict suspended users
if ($user['status'] === 'Suspended') {
    die("Your account has been suspended. You cannot post recipes.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_name = $_POST['recipe-name'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    // Handle Image Upload
    $target_dir = "uploads/";
    $image_path = "uploads/default_recipe.png"; // Default image

    if (!empty($_FILES["image-upload"]["name"])) {
        $target_file = $target_dir . basename($_FILES["image-upload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed image formats
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image-upload"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            }
        }
    }

    // Insert recipe into database
    $stmt = $conn->prepare("INSERT INTO recipe (recipeName, ingredients, instructions, recipeImage, category, user_id) 
                            VALUES (:recipeName, :ingredients, :instructions, :recipeImage, :category, :user_id)");
    $stmt->execute([
        ':recipeName' => $recipe_name,
        ':ingredients' => $ingredients,
        ':instructions' => $instructions,
        ':recipeImage' => $image_path,
        ':category' => $category,
        ':user_id' => $user_id
    ]);

    header("Location: myrecipes.php"); // Redirect to recipes page after submission
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Recipe</title>
    <link rel="stylesheet" href="css/NewRecipe.css">
</head>

<body>
    <header>
        <h1>Add New Recipe</h1>
    </header>

    <main>
        <section class="form-container">
            <form action="add_recipe.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="recipe-name">Recipe Name:</label>
                    <input type="text" id="recipe-name" name="recipe-name" placeholder="Enter recipe name" required>
                </div>
                <div class="form-group">
                    <label for="ingredients">Ingredients:</label>
                    <textarea id="ingredients" name="ingredients" placeholder="List ingredients here..." rows="5"
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Recipe Description:</label>
                    <textarea id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="instructions">Instructions:</label>
                    <textarea id="instructions" name="instructions" placeholder="Write step-by-step instructions..."
                        rows="7" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image-upload">Upload Image:</label>
                    <input type="file" id="image-upload" name="image-upload" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="desserts">Desserts</option>
                        <option value="pastries">Pastries</option>
                        <option value="snacks">Snacks</option>
                        <option value="malay-cuisine">Malay Cuisine</option>
                        <option value="western">Western</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="chinese-cuisine">Chinese Cuisine</option>
                        <option value="indian-cuisine">Indian Cuisine</option>
                        <option value="main-course">Main Course</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" name="add_recipes" value="Post"
                        style="background: #FC94AF; color: white;">
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Cozy Kitchen Delights</p>
    </footer>
</body>

</html>