<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Ensure IT support role is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'it_support') {
    header("Location: index.html");
    exit;
}

// Fetch reported issues from the database
try {
    $stmt = $conn->prepare("SELECT id, issue_title, description, priority, status FROM it_issues WHERE status != 'Resolved'");
    $stmt->execute();
    $issues = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support - View Ticket</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/ITSupport.css">
    <style>
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

        .hidden {
            display: none;
        }

        .ticket-item {
            padding: 10px;
            border: 1px solid #ddd;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ticket-details {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .view-btn {
            padding: 5px 10px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        .resolve-btn {
            padding: 5px 10px;
            background-color: green;
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
            <h1>IT Support</h1>
            <a href="ITSupportViewTicket.php">View Ticket</a>
            <a href="ITSupportViewLogs.php">View Logs</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="header">View Ticket</div>

            <div class="ticket-section">
                <h3>Reported Issues</h3>
                <?php if (!empty($issues)): ?>
                    <?php foreach ($issues as $issue): ?>
                        <div class="ticket-item">
                            <span><strong><?php echo htmlspecialchars($issue['issue_title']); ?></strong></span>
                            <button class="view-btn" onclick="toggleDetails(<?php echo $issue['id']; ?>)">View</button>
                        </div>
                        <div id="details-<?php echo $issue['id']; ?>" class="ticket-details hidden">
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($issue['description']); ?></p>
                            <p><strong>Status:</strong> <?php echo htmlspecialchars($issue['status']); ?></p>
                            <p><strong>Priority:</strong>
                                <span class="priority-<?php echo strtolower(htmlspecialchars($issue['priority'])); ?>">
                                    <?php echo htmlspecialchars($issue['priority']); ?>
                                </span>
                            </p>
                            <button class="resolve-btn" onclick="resolveIssue(<?php echo $issue['id']; ?>)">Resolve</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No unresolved issues at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(issueId) {
            let detailsDiv = document.getElementById("details-" + issueId);
            detailsDiv.classList.toggle("hidden");
        }

        function resolveIssue(issueId) {
            fetch('resolve_issue.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ issue_id: issueId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Issue marked as resolved!");
                        location.reload();
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Failed to update issue.");
                });
        }
    </script>
</body>

</html>