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
// Check if bill ID is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $bill_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM water_bills WHERE id = $bill_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the view bills page after a short delay
        echo "<script>alert('Bill deleted successfully'); window.location.href = 'adminviewbills.php';</script>";

        exit();
    }
    else {
        // Handle any errors
        echo "Error deleting record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // Redirect back to the view bills page if bill ID is not provided
    header("Location: view_bills.php");
    exit();
}
?>
