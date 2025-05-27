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

// Query to retrieve bills from the database
$query = "SELECT * FROM water_bills";
$result = $conn->query($query);

// Check if there are any bills
if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #0074d9;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        p {
            margin: 10px 0;
            text-align: center;
        }
        .edit-link {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        .edit-link:hover {
            background-color: #0056b3;
        }
        .delete-link {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        .delete-link:hover {
            background-color: #0056b3;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex; /* Use flexbox */
            justify-content: center; /* Center align items horizontally */
        
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
        .generate-report-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    </style>
    <title>View Bills</title>
    
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
<h2>Tenant bills</h2>
<p style="font-size: 20px; font-weight: bold;"> Go back to <a href='adminpagee.php' style="color: #4CAF50; text-decoration: none;">Admin Home</a></p>
<div class="reports">
    <h3>Monthly report</h3>
 <form id="monthForm" action="waterbillsreport.php" method="GET">
    <label for="datepicker">Select a month:</label>
    <input type="date" id="datepicker" name="date">
    <button type="submit">Generate Report</button>
</form><br>
<h4 style="font-weight: bold;">Download <a href='allbillsreport.php' style="color: #4CAF50; text-decoration: none;">All Bills</a></h4>
</div>
    <table border="1">
        <tr>
            <th>Bill ID</th>
            <th>Amount</th>
            <th>House number</th>
            <th>Month</th>
            <th>Status</th>
            <th>Amount Paid</th>
            <th>Arrears</th>
            <th>Action</th> <!-- Added action column -->
        </tr>
        <?php
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['house_number']; ?></td>
                <td><?php echo $row['month']; ?></td>
                <td><?php echo ($row['paid'] ? 'Paid' : 'Unpaid'); ?></td>
                <td><?php echo $row['amount_paid']; ?></td>
                <td><?php echo $row['arrears']; ?></td>
                <!-- Edit link column -->
                
                <td>
    <a href='edit_bill.php?id=<?php echo $row['id']; ?>' class='edit-link'>Edit</a>
    <a href='admindeletebill.php?id=<?php echo $row['id']; ?>' class='delete-link' onclick="return confirm('Are you sure you want to delete this bill?')">Delete</a>
</td>

            
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
<?php
} else {
    echo "No bills found.";
}

// Close database connection
$conn->close();
?>
