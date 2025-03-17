<?php
session_start();
include 'actions/db_connect.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

// Fetch the recipe to be edited
if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Fetch the recipe details
    $stmt = $conn->prepare("SELECT * FROM recipe WHERE id = :id AND user_id = :user_id");
    $stmt->execute([':id' => $recipe_id, ':user_id' => $_SESSION['user_id']]);
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    // If recipe not found, redirect
    if (!$recipe) {
        header('Location: User_profile.php');
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_name = $_POST['recipe-name'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $category = $_POST['category'];

    // Handle image upload if new image is selected
    if ($_FILES['image-upload']['name']) {
        $image_upload = $_FILES['image-upload'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image_upload["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($image_upload["tmp_name"], $target_file)) {
                $recipeImage = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $recipeImage = $recipe['recipeImage']; // Keep old image if not updated
    }

    // Update recipe in the database
    $query = "UPDATE recipe SET recipeName = :recipe_name, ingredients = :ingredients, instructions = :instructions, recipeImage = :recipeImage, category = :category WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':recipe_name' => $recipe_name,
        ':ingredients' => $ingredients,
        ':instructions' => $instructions,
        ':recipeImage' => $recipeImage,
        ':category' => $category,
        ':id' => $recipe_id
    ]);

    // Redirect to profile with success message
    header('Location: User_profile.php?update_msg=Your recipe has been updated successfully');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="css/NewRecipe.css"> <!-- Use the same CSS file as New Recipe -->
</head>

<body>
    <header>
        <h1>Edit Recipe</h1>
    </header>

    <main>
        <section class="form-container">
            <form action="edit_recipe.php?id=<?= $recipe['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="recipe-name">Recipe Name:</label>
                    <input type="text" id="recipe-name" name="recipe-name"
                        value="<?= htmlspecialchars($recipe['recipeName']); ?>" placeholder="Enter recipe name"
                        required>
                </div>

                <div class="form-group">
                    <label for="ingredients">Ingredients:</label>
                    <textarea id="ingredients" name="ingredients" placeholder="List ingredients here..." rows="5"
                        required><?= htmlspecialchars($recipe['ingredients']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="instructions">Instructions:</label>
                    <textarea id="instructions" name="instructions" placeholder="Write step-by-step instructions..."
                        rows="7" required><?= htmlspecialchars($recipe['instructions']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image-upload">Upload Image:</label>
                    <input type="file" id="image-upload" name="image-upload" accept="image/*">
                    <br>
                    <img src="<?= htmlspecialchars($recipe['recipeImage']); ?>" alt="Current Image" width="150">
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="Desserts" <?= $recipe['category'] == 'Desserts' ? 'selected' : ''; ?>>Desserts
                        </option>
                        <option value="Pastries" <?= $recipe['category'] == 'Pastries' ? 'selected' : ''; ?>>Pastries
                        </option>
                        <option value="Snacks" <?= $recipe['category'] == 'Snacks' ? 'selected' : ''; ?>>Snacks</option>
                        <option value="Malay Cuisine" <?= $recipe['category'] == 'Malay Cuisine' ? 'selected' : ''; ?>>
                            Malay Cuisine</option>
                        <option value="Western" <?= $recipe['category'] == 'Western' ? 'selected' : ''; ?>>Western</option>
                        <option value="Breakfast" <?= $recipe['category'] == 'Breakfast' ? 'selected' : ''; ?>>Breakfast
                        </option>
                        <option value="Chinese Cuisine" <?= $recipe['category'] == 'Chinese Cuisine' ? 'selected' : ''; ?>>
                            Chinese Cuisine</option>
                        <option value="Indian Cuisine" <?= $recipe['category'] == 'Indian Cuisine' ? 'selected' : ''; ?>>
                            Indian Cuisine</option>
                        <option value="Main Course" <?= $recipe['category'] == 'Main Course' ? 'selected' : ''; ?>>Main
                            Course</option>
                    </select>
                </div>


                <div class="form-group">
                    <button type="submit" name="add_recipes">Update Recipe</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Cozy Kitchen Delights</p>
    </footer>
</body>

</html>