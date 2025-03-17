<?php
session_start();
include 'actions/db_connect.php'; // Database connection

// Check if user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit;
}

// Fetch activity logs from the database (limit to 20 recent logs)
$stmt = $conn->prepare("SELECT user, action, timestamp, status FROM activity_logs ORDER BY timestamp DESC LIMIT 20");
$stmt->execute();
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Activity Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar">
                <nav>
                    <h3><a href="admin.php" style="color: #5b3a29;">Admin Menu</a></h3>
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
                <h1>System Activity Monitor</h1>
            </header>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="chart-container">
                    <h5>Server Activity Overview</h5>
                    <canvas id="activityChart"></canvas>
                </div>

                <div class="table-responsive log-table mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $index => $log): ?>
                                <?php
                                // ✅ Assign different colors based on action type
                                $status_class = "status-success"; // Default green for success
                            
                                if (stripos($log['action'], 'Login Attempt') !== false) {
                                    $status_class = "status-failed"; // Red for failed login attempts
                                } elseif (stripos($log['action'], 'Profile Updated') !== false) {
                                    $status_class = "status-update"; // Blue for profile updates
                                } elseif (stripos($log['action'], 'Logged Out') !== false) {
                                    $status_class = "status-logout"; // Gray for logout
                                } elseif (stripos($log['action'], 'Critical') !== false) {
                                    $status_class = "status-critical"; // Dark red for critical actions
                                }
                                ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($log['user']) ?></td>
                                    <td><?= htmlspecialchars($log['action']) ?></td>
                                    <td><?= htmlspecialchars($log['timestamp']) ?></td>
                                    <td class="<?= $status_class ?>"><?= htmlspecialchars($log['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($logs)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">No activity logs found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'User Logins',
                    data: [12, 19, 10, 15, 22, 18, 24], // Replace with actual data from backend
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Weekly System Activity'
                    }
                }
            }
        });
    </script>

</body>

</html>