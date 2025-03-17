<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Check if IT Support is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'it_support') {
    header("Location: index.html");
    exit;
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

            <!-- Status Bar -->
            <div class="status-bar">System Status: Issue Resolved</div>

            <div class="logs">
                <h3>Resolution Logs</h3>
                <div id="log-content">Loading logs...</div>
            </div>
        </div>
    </div>

    <script>
        // Fetch logs from database via AJAX
        fetch('fetch_logs.php')
            .then(response => response.json())
            .then(data => {
                let logSection = document.getElementById("log-content");
                logSection.innerHTML = ""; // Clear existing content

                if (data.length > 0) {
                    data.forEach(log => {
                        let logItem = document.createElement("div");
                        logItem.innerHTML = `<strong>Title:</strong> ${log.issue_title} <br>
                                         <strong>Description:</strong> ${log.description} <br>
                                         <strong>Priority:</strong> ${log.priority} <br>
                                         <strong>Status:</strong> ${log.status} <br>
                                         <strong>Updated:</strong> ${log.updated_at} <hr>`;
                        logSection.appendChild(logItem);
                    });
                } else {
                    logSection.textContent = "No resolution logs available.";
                }
            })
            .catch(error => {
                console.error('Error fetching logs:', error);
                document.getElementById("log-content").textContent = "Error loading logs.";
            });
    </script>
</body>

</html>