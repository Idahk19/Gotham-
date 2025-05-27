<?php
// Your database connection
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

// Function to link house_number to tenant_id in water_bills table
function linkHouseNumberToTenantId($conn, $tenantId, $houseNumber) {
    // Update water_bills table with the tenant_id based on the house_number
    $updateQuery = "UPDATE water_bills SET tenant_id = '$tenantId' WHERE house_number = '$houseNumber'";
    $conn->query($updateQuery);
}

// Your existing code...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = 2023; // Set the year to 2023
    $successMessage = ''; // Variable to store success message

    foreach ($existingTenantIDs as $tenant_id) {
        $houseNumber = $tenant_id; // Assuming house_number is associated with the tenant_id

        for ($month = 1; $month <= 12; $month++) {
            $amountFieldName = "amount_tenant_${tenant_id}month${month}";

            if (isset($_POST[$amountFieldName])) {
                $amount = $_POST[$amountFieldName];

                if ($amount !== '') { // Check if an amount is provided
                    $month_date = date('Y-m-d', strtotime("$year-$month-01"));

                    // Check if a bill already exists for this tenant and month
                    $checkQuery = "SELECT * FROM water_bills WHERE house_number = '$houseNumber' AND MONTH(month) = '$month' AND YEAR(month) = '$year'";
                    $checkResult = $conn->query($checkQuery);

                    if ($checkResult->num_rows === 0) {
                        // Insert water bill into the database
                        $sql = "INSERT INTO water_bills (tenant_id, house_number, month, amount) VALUES ('$tenant_id', '$houseNumber', '$month_date', '$amount')";
                        $conn->query($sql);
                    } else {
                        // Alert or notify that a bill already exists
                        echo "<script>alert('A bill already exists for House Number: $houseNumber and Month: $month');</script>";
                    }
                }
            }
        }
    }
    $successMessage = "Water bills processed successfully!";
    echo "<script>alert('$successMessage'); window.location.href = 'adminpage.php';</script>";
}
?>
