<?php
session_start();

// Your database credentials
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
$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';
$houseNumber = $_POST['house_number'] ?? '';

// Using prepared statements to prevent SQL injection
$query = "SELECT * FROM tenants WHERE name = ? AND house_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $name, $houseNumber); // Assuming name is of string type and house_number is of integer type
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Match found, check the password
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
       
        // Match found, set session data and redirect to some authenticated page
        $_SESSION['tenant_name'] = $name;
        $_SESSION['house_number'] = $houseNumber; // Assuming 'tenant_name' is the session variable
        header("Location: viewbills.php");
        exit();
    }
}
echo "<script>alert('Incorrect username or password'); window.location.href = 'tenantlogin.php';</script>";
exit();

$stmt->close();
$conn->close();
?>
