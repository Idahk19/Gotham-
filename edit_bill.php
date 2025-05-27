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

// Check if bill ID is provided
if(isset($_GET['id'])) {
    // Retrieve the bill details based on the ID
    $bill_id = $_GET['id'];
    
    // Perform a database query to get the bill details based on $bill_id
    $query = "SELECT * FROM water_bills WHERE id = $bill_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Bill found, fetch details
        $bill = $result->fetch_assoc();
        
        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Retrieve edited information from the form
            $amount = $_POST['amount'];
            $house_number = $_POST['house_number'];
            $month = $_POST['month'];
            $status = $_POST['status'];
            $amount_paid = $_POST['amount_paid'];
            $arrears = $_POST['arrears'];

            // Update the bill information in the database
            $update_query = "UPDATE water_bills SET amount='$amount', house_number='$house_number', month='$month', paid='$status', amount_paid='$amount_paid', arrears='$arrears'  WHERE id=$bill_id";
            $update_result = $conn->query($update_query);

            if ($update_result) {
                // Bill updated successfully, redirect to view all bills page
                echo "<script>alert('Bill updated successfully'); window.location.href = 'adminviewbills.php';</script>";
                exit();
            } else {
                echo "Error updating bill: " . $conn->error;
            }
        }
    } else {
        echo "Bill not found!";
    }
} else {
    // Bill ID not provided in the URL, handle the error
    echo "Bill ID is missing!";
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        select {
            margin-bottom: 30px; /* Adjust spacing */
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Bill</h1>
    <form method="post">
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" value="<?php echo $bill['amount']; ?>">
        
        <label for="house_number">House Number:</label>
        <input type="text" id="house_number" name="house_number" value="<?php echo $bill['house_number']; ?>">
        
        <label for="month">Month:</label>
        <input type="text" id="month" name="month" value="<?php echo $bill['month']; ?>">
        
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="1" <?php if($bill['paid']) echo "selected"; ?>>Paid</option>
            <option value="0" <?php if(!$bill['paid']) echo "selected"; ?>>Unpaid</option>
        </select>
        
        <label for="month">Amount Paid:</label>
        <input type="text" id="amount_paid" name="amount_paid" value="<?php echo $bill['amount_paid']; ?>">
        
        <label for="month">Arrears:</label>
        <input type="text" id="arrears" name="arrears" value="<?php echo $bill['arrears']; ?>">

        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
