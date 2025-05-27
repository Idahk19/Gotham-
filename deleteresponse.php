<?php
// delete_response.php

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Assuming you have received the response ID through GET method
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $responseId = $_GET['id'];

    // Delete the response from the database
    $stmt = $pdo->prepare("DELETE FROM reported_issues WHERE id = ?");
    $stmt->execute([$responseId]);

    // Redirect back to the view responses page after deleting
    echo "<script>alert('Response deleted successfully'); window.location.href = 'adminviewresponses.php';</script>";
    
    exit();
} else {
    // If response ID is not provided or invalid, redirect back to the view responses page
    header("Location: view_responses.php");
    exit();
}
?>
