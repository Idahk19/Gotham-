<?php
// fetch_approval_status.php

// Replace this with your actual database connection and query logic
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");
$stmt = $pdo->prepare('SELECT COUNT(*) AS approvedRequests FROM authorization_requests WHERE authorized = 1 AND status="unpaid"');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Return a JSON response
header('Content-Type: application/json');
echo json_encode(['approvedRequests' => intval($result['approvedRequests']) > 0]);
?>
