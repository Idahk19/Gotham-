<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Tenants</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #0074d9;
            color: white;
        }
        .delete-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        p {
            margin: 10px 0;
            text-align: center; 
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
</div> <br>
<p style="font-size: 20px; font-weight: bold;"> Go back to <a href='adminpagee.php' style="color: #4CAF50; text-decoration: none;">admin home</a></p>

<div class="reports">
<h3>Monthly report</h3>
<h4> To download a report for all tenants do not input a month </h4><br>
<form id="monthForm" action="tenantsreport.php" method="GET">
    <label for="month">Select a month and year:</label>
    <input type="text" id="month" name="month" placeholder="MM/YYYY">
    <button type="submit">Generate Report</button>
</form><br>



<?php
// Start session
session_start();

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Check if delete request is made
if(isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    // Get the ID of the tenant to be deleted
    $delete_id = $_GET['delete_id'];

    // Delete the tenant from the database
    $delete_stmt = $pdo->prepare("DELETE FROM tenants WHERE tenant_id = ?");
    $delete_stmt->execute([$delete_id]);

    // Redirect back to this page after deletion
    echo "<script>alert('Tenant deleted successfully'); window.location.href = 'tenantsregistered.php';</script>";
    exit();
}

// Query to fetch tenant information
$stmt = $pdo->query("SELECT * FROM tenants");

// HTML output for displaying tenant information
echo "<h2 style='text-align: center;'>Registered Tenants</h2>";

echo "<table border='1'>";
echo "<tr><b><th>ID</th><th>Name</th><th>Email</th><th>House number</th><th>Created at</th><th>Action</th><b></tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><b>";
    echo "<td>" . $row['tenant_id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['house_number'] . "</td>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "<td><a href='?delete_id=" . $row['tenant_id'] . "' class='delete-button' onclick=\"return confirm('Are you sure you want to delete this tenant?')\">Delete</a></td>";
    echo "<b></tr>";
}

echo "</table>";

// Close database connection
$pdo = null;
?>

</body>
</html>
