<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit;
}

// ✅ Fetch total number of registered users (excluding admins)
$userCountStmt = $conn->prepare("SELECT COUNT(*) AS total_users FROM users WHERE role != 'admin'");
$userCountStmt->execute();
$userCount = $userCountStmt->fetch(PDO::FETCH_ASSOC)['total_users'];

// ✅ Fetch total number of posts (recipes)
$postCountStmt = $conn->prepare("SELECT COUNT(*) AS total_posts FROM recipe");
$postCountStmt->execute();
$postCount = $postCountStmt->fetch(PDO::FETCH_ASSOC)['total_posts'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    
    <!-- ✅ FontAwesome for icons -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar">
                <nav>
                    <h7>
                        <div class="admin"><a href="admin.php" style="color: #5b3a29;">Admin Menu</a></div>
                    </h7>
                    <ul class="list-unstyled">
                        <li><a href="View_User.php" class="nav-link">User Management</a></li>
                        <li><a href="SystemActivity.php" class="nav-link">System Activity</a></li>
                        <li><a href="adminhelp_support.php" class="nav-link">Help & Support</a></li>
                        <li><a href="logout.php" class="nav-link">Logout</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Header -->
            <header class="header col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1>Admin Dashboard</h1>
            </header>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex flex-column align-items-center py-4">
                    <img src="userImages/Gordon_Ramsay.jpg" alt="Profile" class="profile-img">
                    <h3 class="mt-3"><?= htmlspecialchars($_SESSION['username']) ?></h3>
                    <p>Admin</p>
                </div>

                <!-- ✅ Statistics Cards -->
                <div class="row">
                    <!-- Number of Registered Users -->
                    <div class="col-md-6">
                        <div class="card card-custom text-center shadow-sm">
                            <div class="card-body">
                                <i class="fa-solid fa-users fa-3x text-primary"></i> <!-- 👥 Icon for users -->
                                <h5 class="card-title mt-3">Registered Users</h5>
                                <p class="card-text display-4 fw-bold"><?= htmlspecialchars($userCount) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Number of Posts -->
                    <div class="col-md-6">
                        <div class="card card-custom text-center shadow-sm">
                            <div class="card-body">
                                <i class="fa-solid fa-file-arrow-up fa-3x text-success"></i> <!-- 📤 Icon for posts -->
                                <h5 class="card-title mt-3">Total Posts</h5>
                                <p class="card-text display-4 fw-bold"><?= htmlspecialchars($postCount) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
        document.querySelector('.sidebar').addEventListener('mouseenter', function () {
            this.style.width = '200px';
        });
        document.querySelector('.sidebar').addEventListener('mouseleave', function () {
            this.style.width = '180px';
        });

    </script>
</body>

</html>