<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Ensure IT support role is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'it_support') {
    header("Location: index.html");
    exit;
}

// Fetch resolved issues from the database
try {
    $stmt = $conn->prepare("SELECT id, issue_title, description, priority, status, updated_at FROM it_issues WHERE status = 'Resolved' ORDER BY updated_at DESC");
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support - View Logs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/ITSupport.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .priority-low {
            background-color: lightgreen;
            color: black;
            padding: 5px;
            border-radius: 3px;
        }

        .priority-medium {
            background-color: orange;
            color: white;
            padding: 5px;
            border-radius: 3px;
        }

        .priority-high {
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 3px;
        }

        .priority-critical {
            background-color: purple;
            color: white;
            padding: 5px;
            border-radius: 3px;
        }

        .export-btn {
            margin-top: 10px;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="nav">
            <h2>IT Support</h2>
            <a href="ITSupportViewTicket.php">View Ticket</a>
            <a href="ITSupportViewLogs.php">View Logs</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="header">View Logs</div>

            <button class="export-btn" onclick="exportLogs()">Export to CSV</button>

            <table>
                <tr>
                    <th>Issue Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Resolved Date</th>
                </tr>
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($log['issue_title']); ?></td>
                            <td><?php echo htmlspecialchars($log['description']); ?></td>
                            <td>
                                <span class="priority-<?php echo strtolower(htmlspecialchars($log['priority'])); ?>">
                                    <?php echo htmlspecialchars($log['priority']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($log['status']); ?></td>
                            <td><?php echo htmlspecialchars($log['updated_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No resolved issues yet.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <script>
        function exportLogs() {
            window.location.href = "export_logs.php";
        }
    </script>
</body>

</html>