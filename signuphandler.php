<?php
// Your database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "watermdb";

// Create connection
$conn = new mysqli($hostname, $username, $password, $db_name);

// Assuming form submission to sign up a tenant
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the signup form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $houseNumber = $_POST['house_number']; // Assuming the input field in the form is named 'house_number'
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the tenant details into the tenants table using a prepared statement
    $sql = "INSERT INTO tenants (name, email, house_number, password) VALUES (?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ssis", $name, $email, $houseNumber, $hashedPassword);

    if ($stmt->execute()) {
        // Fetch the tenant_id for the newly inserted tenant
        $newTenantId = $stmt->insert_id;
        echo "<script>alert('Signed up successfully'); window.location.href = 'home.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
