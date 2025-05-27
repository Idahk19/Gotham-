<?php
// Database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "watermdb";

// Create connection
$conn = new mysqli($hostname, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if issue ID is provided
if(isset($_GET['id']) && isset($_POST['reply'])) {
    $issue_id = $_GET['id'];
    $reply_text = $_POST['reply'];

    // Escape user input to prevent SQL injection
    $reply_text = mysqli_real_escape_string($conn, $reply_text);

    // Update the database with the reply
    $query = "UPDATE reported_issues SET status='$reply_text' WHERE id=$issue_id";
    $result = $conn->query($query);

    if ($result === TRUE) {
        $successMessage = "Thankyou!Reply sent successfully!";
        echo "<script>alert('$successMessage'); window.location.href = 'reported_issues.php';</script>";
    exit;
}else {
        echo "Error recording reply: " . $conn->error;
    }
} 
// Close database connection
$conn->close();
?>
