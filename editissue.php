<?php
// Start session
session_start();

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Check if issue ID is provided through GET method and is not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Retrieve the issue ID from the URL parameter
    $issueId = $_GET['id'];

    // Fetch the issue data from the database based on the issue ID
    $stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE id = ?");
    $stmt->execute([$issueId]);
    $issue = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if issue exists
    if($issue) {
        // Check if form is submitted with POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get updated issue description from the form
            $updatedDescription = $_POST['issue_description'];

            // Update the issue description in the database
            $updateStmt = $pdo->prepare("UPDATE reported_issues SET issue_description = ? WHERE id = ?");
            $updateStmt->execute([$updatedDescription, $issueId]);

            // Redirect back to the page where issues are displayed
            header("Location: view_issues.php");
            exit();
        }

        // Display the form for editing the issue
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Issue</title>
        </head>
        <body>
            <h1>Edit Issue</h1>
            <form action="updateissue.php" method="post">
                <!-- Display issue data in the form for editing -->
                <input type="hidden" name="issue_id" value="<?php echo $issue['id']; ?>">
                <label for="issue_type">Issue Type:</label>
<input type="text" id="issue_type" name="issue_type" value="<?php echo $issue['issue_type']; ?>">

                <label for="issue_description">Issue Description:</label>
                <input type="text" id="issue_description" name="issue_description" value="<?php echo $issue['issue_description']; ?>">
                <input type="submit" value="Update Issue">
            </form>
        </body>
        </html>
        <?php
    } else {
        // If issue with provided ID is not found, redirect back to the view issues page
        header("Location: view_issues.php");
        exit();
    }
} else {
    // If issue ID is not provided or invalid, redirect back to the view issues page
    header("Location: view_issues.php");
    exit();
}

// Close database connection
$pdo = null;
?>
