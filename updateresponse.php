<?php
// update_response.php

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Check if form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the edited response data from the form
    $responseId = $_POST['response_id'];
    $newResponseStatus = $_POST['response_status'];

    // Update the corresponding record in the database
    $stmt = $pdo->prepare("UPDATE reported_issues SET status = ? WHERE id = ?");
    $stmt->execute([$newResponseStatus, $responseId]);

    // Redirect back to the view responses page after updating
    echo "<script>alert('Response updated successfully'); window.location.href = 'adminviewresponses.php';</script>";
    exit();
} else {
    // If form is not submitted with POST method, redirect back to the view responses page
    header("Location: view_responses.php");
    exit();
}

// Close database connection
$pdo = null;
?>
