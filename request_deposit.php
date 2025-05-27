<?php
session_start();

// Initialize variables to avoid "undefined variable" errors
$tenantId = null;
$month = null;
$amount = null;

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if tenant_name is set in the session
    if (isset($_SESSION['tenant_name'])) {
        $tenantId = $_SESSION['tenant_name'];
    } else {
        // Handle the case where tenant_name is not set
        exit("Error: Tenant ID not set.");
    }

    // Check if month and amount are set in the POST data
    if (isset($_POST['month']) && isset($_POST['amount'])) {
        $month = $_POST['month'];
        $amount = $_POST['amount'];
    } else {
        // Handle the case where month or amount is not set
        exit("Error: Month or amount not set.");
    }

    // Insert the deposit authorization request into the database
    try {
        // Connect to the database (adjust these settings according to your database configuration)
        $pdo = new PDO('mysql:host=localhost;dbname=watermdb', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO authorization_requests (tenant_name, amount, month) VALUES (:tenant_name, :amount, :month)");

        // Bind parameters
        $stmt->bindParam(':tenant_name', $tenantId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':month', $month);

        // Execute the statement
        $stmt->execute();

        // Send response to the client
        echo "Deposit authorization request sent to the admin. Please wait for approval.";
    } catch (PDOException $e) {
        // Handle database errors
        exit("Error: " . $e->getMessage());
    }
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo "Method not allowed";
}
?>
