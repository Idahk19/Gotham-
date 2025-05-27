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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $tenantName = htmlspecialchars($_POST["tenant_name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $issueType = htmlspecialchars($_POST["issue_type"]);
    $issueDescription = htmlspecialchars($_POST["issue_description"]);

    // Insert the reported issue into the database
    $insertQuery = "INSERT INTO reported_issues (tenant_name, email, issue_type, issue_description)
                    VALUES ('$tenantName', '$email', '$issueType', '$issueDescription')";
      if ($conn->query($insertQuery) === TRUE) {
        $successMessage = "Thankyou!Report sent successfully!";
        echo "<script>alert('$successMessage'); window.location.href = 'contactus.php';</script>";
        exit;
    }else {
        // Set an error message in the session
        $_SESSION['message'] = "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Redirect to the Contact.php page
header("Location: Contact.php");
exit();
?>               

   