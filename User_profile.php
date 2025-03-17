<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

// Fetch user data from the database (including profile picture and social links)
$stmt = $conn->prepare("
    SELECT username, email, phone_number, address, gender, profile_picture, 
           facebook, twitter, instagram, bio 
    FROM users WHERE id = :user_id
");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle optional address field
$address = !empty($user['address']) ? htmlspecialchars($user['address']) : "Not provided";

// Check if the user has a profile picture; otherwise, use default
$profile_picture = !empty($user['profile_picture']) ? $user['profile_picture'] : "uploads/default.png";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/UserProfile.css">
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet">

    <style>
        .recipe-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Creates 3 equal-width columns */
            gap: 20px;
            padding: 20px;
        }

        .recipe-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            background: white;
        }

        .recipe-card:hover {
            transform: scale(1.05);
        }

        .recipe-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .recipe-card .recipe-info {
            padding: 15px;
            text-align: center;
        }

        .recipe-card h3 {
            margin: 10px 0;
            font-size: 18px;
        }

        .recipe-card p {
            font-size: 14px;
            color: #666;
        }

        .recipe-card .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
        }

        .recipe-card .buttons a {
            text-decoration: none;
            background: #ff7f50;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .recipe-card .buttons a:hover {
            background: #ff5733;
        }

        /* Social Media Icons */
        .social-media-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-media-links a {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-size: cover;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-size: 18px;
            color: white;
            transition: transform 0.3s;
        }

        .social-media-links a:hover {
            transform: scale(1.1);
        }

        /* Default placeholder styles for icons */
        .facebook {
            background-image: url('iconImages/Facebook%20Icon.jpeg');
            /* Replace with actual icon path */
        }

        .twitter {
            background-image: url('iconImages/X%20Icon.jpeg');
            /* Replace with actual icon path */
        }

        .instagram {
            background-image: url('iconImages/Instagram%20Icon.jpeg');
            /* Replace with actual icon path */
        }
    </style>
</head>

<body>
    <header>
        <h1>Cozy Kitchen Delights♡</h1>
    </header>

    <nav class="headnav">
        <div class="navigatebar">
            <a href="registereduser_home.php" class="home-link">
                <i class="fa-solid fa-house"></i>
            </a>
            <a href="user_profile.php" class="profile">
                <i class="fa-solid fa-user"></i>
            </a>
            <a href="User_update.php">Edit Profile</a>
            <a href="User_update_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="card">
        <div class="sidebar">
            <div class="avatar-container">
                <img src="<?= htmlspecialchars($profile_picture); ?>" alt="Profile Picture">
            </div>
            <h2><?= htmlspecialchars($user['username']); ?></h2>
            <p>@<?= htmlspecialchars($user['username']); ?></p>
            <div class="nav-links">
                <a href="NewRecipe.php" class="nav-link">Create Recipe</a>
                <a href="user_favorite.php" class="nav-link">Saved Recipes</a>
            </div>
        </div>

        <div class="content">
            <h3>My Profile</h3>
            <div>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone_number']); ?></p>
                <p><strong>Address:</strong> <?= $address; ?></p>
                <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']); ?></p>
                <p><strong>Bio:</strong> <?= htmlspecialchars($user['bio']); ?></p>

                <!-- Social Media Icons -->
                <div class="social-media-links">
                    <?php if (!empty($user['facebook'])): ?>
                        <a href="<?= htmlspecialchars($user['facebook']); ?>" target="_blank" class="facebook"></a>
                    <?php endif; ?>
                    <?php if (!empty($user['twitter'])): ?>
                        <a href="<?= htmlspecialchars($user['twitter']); ?>" target="_blank" class="twitter"></a>
                    <?php endif; ?>
                    <?php if (!empty($user['instagram'])): ?>
                        <a href="<?= htmlspecialchars($user['instagram']); ?>" target="_blank" class="instagram"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <h5>My Recipes</h5>
    <div class="recipe-container">
        <?php
        // Fetch recipes of the logged-in user
        $query = "SELECT * FROM recipe WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);

        // Check if any recipes exist
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="recipe-card">
                    <img src="uploads/<?= basename($row['recipeImage']); ?>" alt="Recipe Image">
                    <div class="recipe-info">
                        <h3><?= htmlspecialchars($row['recipeName']); ?></h3>
                        <p><?= htmlspecialchars(substr($row['ingredients'], 0, 50)) . '...'; ?></p>
                    </div>
                    <div class="buttons">
                        <a href="view_recipe.php?id=<?= $row['id']; ?>" style="background: #FC94AF;">View</a>
                        <a href="edit_recipe.php?id=<?= $row['id']; ?>" style="background: #FC94AF;">Edit</a>
                        <a href="delete_recipe.php?id=<?= $row['id']; ?>" style="background: red;">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No recipes found.</p>";
        }
        ?>
    </div>

</body>

</html>