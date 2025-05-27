<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to authenticate users
function login($username, $password) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "watermdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch the password for the given username
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if ($password == $row['password']) {
            // Authentication successful, redirect to the admin page
            header("Location: adminpagee.php");
            exit; // Make sure to exit after redirection
        } else { 
            
            echo "<script>alert('Wrong password'); window.location.href = 'adminlogin.php';</script>";

        }
    } else {
        echo "<script>alert('Username not found'); window.location.href = 'adminlogin.php';</script>";

    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Trim whitespace from username and password
    $username = trim($username);
    $password = trim($password);

    // Check if username or password is empty
    if (empty($username) || empty($password)) {
        echo "<script>alert('username & password required'); window.location.href = 'adminlogin.php';</script>";
        exit;
    } else {
        // Call login function
        login($username, $password);
    }
}
?>
