<?php
// Include the database connection file
include 'actions/db_connect.php';  // Make sure the path is correct

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: index.php');
    exit;
}

if (isset($_POST['add_recipes'])) {

    // Retrieve form inputs
    $recipe_name = $_POST['recipe-name'];
    $description = $_POST['description'];  // Added description
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $image_upload = $_FILES['image-upload'];  // For image upload, use $_FILES
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];  // Get the user_id from the session

    // Handling image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image_upload["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if the uploaded file is an image
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($image_upload["tmp_name"], $target_file)) {
            // File uploaded successfully

            // Prepare the SQL query using PDO (Added description column)
            $query = "INSERT INTO recipe (recipeName, description, ingredients, instructions, recipeImage, category, user_id) 
                      VALUES (:recipe_name, :description, :ingredients, :instructions, :recipeImage, :category, :user_id)";

            // Prepare the statement
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':recipe_name', $recipe_name);
            $stmt->bindParam(':description', $description);  // Bind description
            $stmt->bindParam(':ingredients', $ingredients);
            $stmt->bindParam(':instructions', $instructions);
            $stmt->bindParam(':recipeImage', $target_file);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':user_id', $user_id);  // Bind the user_id

            // Execute the query
            $result = $stmt->execute();

            if ($result) {
                header('Location: user_profile.php?insert_msg=Your recipe has been added successfully');
                exit;
            } else {
                echo "There was an error inserting the recipe.";
            }
        } else {
            // Handle upload failure
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}
?>
