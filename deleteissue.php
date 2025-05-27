<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Check if issue ID is provided through GET method
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $issueId = $_GET['id'];

    // Delete the issue from the database
    $stmt = $pdo->prepare("DELETE FROM reported_issues WHERE id = ?");
    $stmt->execute([$issueId]);

    // Redirect back to the page where issues are displayed
    
    echo "<script>alert('Issue deleted successfully'); window.location.href = 'view responses.php';</script>";
    exit();
} else {
    // If issue ID is not provided or invalid, redirect back to the page where issues are displayed
    header("Location: view_issues.php");
    exit();
}
?>
