<?php
session_start();
include 'actions/db_connect.php';

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

// Check if the recipe ID is set
if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Fetch the recipe name and image to use in the confirmation message
    $stmt = $conn->prepare("SELECT recipeName, recipeImage FROM recipe WHERE id = :id AND user_id = :user_id");
    $stmt->execute([':id' => $recipe_id, ':user_id' => $_SESSION['user_id']]);
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
        // If the user confirms the deletion, proceed with the deletion
        if (isset($_POST['delete_confirmed']) && $_POST['delete_confirmed'] == 'yes') {
            // Delete the recipe from the database
            $delete_stmt = $conn->prepare("DELETE FROM recipe WHERE id = :id AND user_id = :user_id");
            $delete_stmt->execute([':id' => $recipe_id, ':user_id' => $_SESSION['user_id']]);

            // Redirect after successful deletion
            header('Location: User_profile.php?delete_msg=Recipe has been deleted successfully');
            exit;
        }
    } else {
        // Redirect if recipe not found
        header('Location: User_profile.php');
        exit;
    }
} else {
    // Redirect if no ID is provided
    header('Location: User_profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Recipe</title>
    <script>
        // JavaScript function to confirm deletion
        function confirmDeletion(recipeName, recipeId) {
            const confirmation = confirm("Are you sure you want to delete the recipe: " + recipeName + "?");
            if (confirmation) {
                // Proceed with form submission if user clicks "Yes"
                document.getElementById('deleteForm').submit();
            } else {
                // Cancel deletion
                return false;
            }
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FCBACB; /* Soft brown background */
            padding: 40px;
            color: #3e2c1c; /* Dark brown text color */
        }

        .delete-container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #a52a2a;
            font-size: 28px;
        }

        .recipe-image-container {
            margin: 20px 0;
        }

        .recipe-image {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            margin: 10px 0;
        }

        .recipe-name {
            font-size: 24px;
            font-weight: bold;
            color: #3e2c1c;
        }

        .confirmation-text {
            font-size: 16px;
            color: #5a4d3b;
            margin-top: 15px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .buttons button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .buttons button:hover {
            background-color: #8b3a3a;
        }

        .buttons a button {
            background-color: #FE7F9C; /* Lighter brown for cancel */
        }

        .buttons a button:hover {
            background-color: #F25278;
        }
    </style>
</head>

<body>

    <header>
        <h1>Cozy Kitchen Delights</h1>
    </header>

    <main>
        <div class="delete-container">
            <h2>Are you sure you want to delete this recipe?</h2>

            <?php if (isset($recipe)): ?>
                <!-- Recipe Image and Name -->
                <div class="recipe-image-container">
                    <img class="recipe-image" src="uploads/<?= basename($recipe['recipeImage']); ?>" alt="Recipe Image">
                </div>
                
                <p class="recipe-name"><?= htmlspecialchars($recipe['recipeName']); ?></p>
                <p class="confirmation-text">Once deleted, this action cannot be undone.</p>

                <!-- Hidden form to trigger deletion on confirmation -->
                <form id="deleteForm" method="POST" action="delete_recipe.php?id=<?= $recipe_id; ?>">
                    <input type="hidden" name="delete_confirmed" value="yes">
                </form>

                <!-- Action Buttons -->
                <div class="buttons">
                    <button onclick="confirmDeletion('<?= htmlspecialchars($recipe['recipeName']); ?>', '<?= $recipe_id; ?>')">Yes, Delete</button>
                    <a href="User_profile.php"><button>No, Cancel</button></a>
                </div>

            <?php else: ?>
                <p>Recipe not found or invalid ID.</p>
            <?php endif; ?>

        </div>
    </main>

    <footer>
        <p>&copy; 2025 Cozy Kitchen Delights</p>
    </footer>

</body>

</html>

