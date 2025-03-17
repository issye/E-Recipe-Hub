<?php
require_once 'actions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = isset($_POST['query']) ? trim($_POST['query']) : '';
    $category = isset($_POST['category']) ? trim($_POST['category']) : '';

    $sql = "SELECT id, recipeName, description, recipeImage FROM recipe WHERE 1";

    // If the user entered a search term
    if (!empty($query)) {
        $sql .= " AND recipeName LIKE :query";
    }

    // If the user selected a category
    if (!empty($category) && $category !== 'all') {
        $sql .= " AND category = :category";
    }

    $stmt = $conn->prepare($sql);

    if (!empty($query)) {
        $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
    }

    if (!empty($category) && $category !== 'all') {
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    }

    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($recipes);
}
?>