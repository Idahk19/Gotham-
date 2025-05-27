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

// Populate $TenantIDs and $houseNumbers with actual data
$TenantIDs = [];
$houseNumbers = [];

for ($i = 1; $i <= 10; $i++) {
    $TenantIDs[] = $i;
    $houseNumbers[] = $i;
}

// Database connection and form processing logic here...

// Form processing logic

// Form processing logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $successMessage = ''; // Variable to store success message

    foreach ($TenantIDs as $houseNumber) {
        // Set the house number for the current iteration
        $house_number = $houseNumber;

        for ($month = 1; $month <= 12; $month++) {
            $amountFieldName = "amount_tenant_${houseNumber}_house_${houseNumber}_month_${month}";

            if (isset($_POST[$amountFieldName])) {
                $amount = $_POST[$amountFieldName];

                if ($amount !== '') {
                    $year = date('Y');
                    // Set the month_date to the last day of the month
$month = date('Y-m-d', strtotime("last day of $year-$month"));


                    $checkQuery = "SELECT 1 FROM water_bills WHERE house_number = ? AND MONTH(month) = ? AND YEAR(month) = ?";
                    $stmt = $conn->prepare($checkQuery);
                    $stmt->bind_param("iii", $house_number, $month, $year);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $successMessage .= "A bill already exists for house $houseNumber in month $month. ";
                    } else {
                  // Insert the bill into the database
                  $stmt = $conn->prepare("INSERT INTO water_bills ( amount, house_number, month, arrears) VALUES (?, ?, ?,?)");
                  $stmt->bind_param("iisi", $amount, $house_number, $month, $amount); // Assuming arrears starts as the amount
                  $stmt->execute();

                        if ($stmt->affected_rows === 1) {
                            $successMessage .= "Water bill inserted successfully for house $houseNumber in month $month. ";
                        } else {
                            $errorMessage .= "Error inserting water bill for house $houseNumber in month $month: " . $conn->error . ". ";
                        }
                    }
                }
            }
        }
    }

    // Close database connection
    $conn->close();

    if (!empty($errorMessage)) {
        echo "<script>alert('$errorMessage');</script>";
    }

    if (!empty($successMessage)) {
        echo "<script>alert('$successMessage'); window.location.href = 'bill_insert.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page - Insert Water Bills</title>
    <style>
      body{
            font-family: Arial, sans-serif;
            background-image: url('homeimage.JPEG');
        }

        header {
            background-color: #add8e6;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h3 {
            color: black;
            text-align: center;
        }

        footer {
            background-color: #add8e6;
            color: #333;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            border-top: 2px solid #333;
            margin-top: 20px;
        }

        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            text-align: center;
            width: 70%;
        }

        button {
            background-color: #0074d9;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
        }

        .blue-text {
            color: #0074d9;
        }

        .black-text {
            color: black;
        }
        p {
            margin: 10px 0;
            text-align: center; 
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex; 
            justify-content: center; 
        
        }
        .navbar a {
            float: left;
            display: inline-block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .active {
            background-color: #007bff;
            color: white;
        }
        .input-container {
        margin-bottom: 5px; 
    }
    .input-container label {
        display: block; 
        margin-bottom: 1px;
    }
    .input-container input[type="text"] {
        width: 30%; 
        padding: 5px; 
        box-sizing: border-box; 
    }
        @media (max-width: 600px) {
    .input-container {
        width: 100%;
    }
}

    </style>
</head>
<body>
<div class="navbar">
    <a class="active" href="tenantsregistered.php">View registered users</a>
    <a href="bill_insert.php">Insert bills</a>
    <a class="active" href="adminviewbills.php">View and edit Bills</a>
    <a href="reported_issues.php" >View reported issues</a>
    <a class="active" href="adminviewresponses.php">View your issue responses</a>
    <a href="requests.php">View deposit requests</a>
</div>
    <h3>Insert Water Bills for Tenants</h3>
 
<p style="font-size: 20px; font-weight: bold;"> Go back to <a href='adminpagee.php' style="color: #4CAF50; text-decoration: none;">Admin home</a></p>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <?php 
    // Display the form for entering water bills
    foreach ($TenantIDs as $key) {
        $houseNumber = $key;
        echo '<div style="margin-bottom: 20px;">';
        echo '<h2>Tenant ' . $key . ', House ' . $houseNumber . '</h2>';
     for ($month = 1; $month <= 12; $month++) {
            // Now you can use $houseNumber and $key in your queries
            $amountFieldName = "amount_tenant_${key}_house_${houseNumber}_month_${month}";

            echo '<div class="input-container">';
    echo '<label for="' . $amountFieldName . '">';
    echo 'Month ' . $month . ':';
    echo '</label>';
    echo '<input type="text" name="' . $amountFieldName . '" id="' . $amountFieldName . '">';
    echo '</div>';
}
echo '</div>';
      
    }
?>  
<button type="submit">Submit</button>
    </form>
    
    </body>
</html> 