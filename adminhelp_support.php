<?php
session_start();
include 'actions/db_connect.php'; // Ensure database connection

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$success_message = ""; // Variable to store success message

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $issue_title = htmlspecialchars($_POST['issue_title']);
    $description = htmlspecialchars($_POST['issue_description']);
    $priority = htmlspecialchars($_POST['priority']);

    try {
        // Insert issue into the database
        $stmt = $conn->prepare("INSERT INTO it_issues (user_id, issue_title, description, priority) VALUES (:user_id, :issue_title, :description, :priority)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':issue_title' => $issue_title,
            ':description' => $description,
            ':priority' => $priority
        ]);

        // Set success message
        $success_message = "Issue reported successfully!";
    } catch (PDOException $e) {
        $success_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Technical Issues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
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

            <header class="header col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1>Report Technical Issues</h1>
            </header>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="report-container">
                    <h5>Submit a Technical Issue</h5>

                    <!-- Success Message -->
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="issueTitle" class="form-label">Issue Title</label>
                            <input type="text" class="form-control" id="issueTitle" name="issue_title" placeholder="Enter a brief issue title" required>
                        </div>
                        <div class="mb-3">
                            <label for="issueDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="issueDescription" name="issue_description" rows="5" placeholder="Describe the issue in detail" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Critical">Critical</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-submit">Submit Issue</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
