<?php
// fetch_new_reported_issues.php

// Replace this with your actual database connection and query logic
// Assume you have a table named "reported_issues" with a column "status" indicating if an issue is new
// Adjust the SQL query based on your database schema
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");
$stmt = $pdo->prepare('SELECT COUNT(*) AS newIssues FROM reported_issues WHERE status = "pending"');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Return a JSON response
header('Content-Type: application/json');
echo json_encode(['newIssues' => intval($result['newIssues']) > 0]);
?>

  