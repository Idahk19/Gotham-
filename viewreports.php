<?php
// Start session
session_start();

// Check if the tenant is logged in
if(!isset($_SESSION['tenant_name'])) {
    // Redirect to the login page if not logged in
    header("Location: tenantlogin.php");
    exit();
}

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Fetch the tenant's reported issues from the database
$stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE tenant_name = ?");
$stmt->execute([$_SESSION['tenant_name']]);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tenants' Reported Issues</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #f5f5f5;
        }

        footer p {
            font-size: 14px;
            color: #666;
        }
             .reported-issues-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color:  #f2f2f2;
            color: black;
        }


        .edit-button, .delete-button, .btn {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }

        .edit-button:hover, .delete-button:hover {
            background-color: #0056b3;
        }
        header {
            background-color: #0074D9;
            padding: 20px 0;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo a {
            color: #fff;
            font-size: 1.5rem;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin-right: 20px;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>
<body>
<header>
        <nav>
            <div class="logo">
                <a href="#">Gotham flo pro</a>
            </div>
            <ul class="nav-links">
                <li><a href="viewbills.php">My bills</a></li>
                &nbsp;&nbsp;
                <li><a href="viewreports.php">My reported issues</a></li>
                &nbsp;&nbsp;
                <li><a href="contactus.php">Report Issues</a></li>
               
            </ul>
        </nav>
    </header>
    <h2>Your Reported Issues</h2>
  
    <div class="reported-issues-container">
        <?php
        // Check if there are any issues reported by the tenant
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>Issue</th><th>Action</th><th>Admin Response</th></tr>";
            // Loop through the results and display each issue
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['issue_description'] . "</td>";
                echo "<td>";
                echo "<a href='updateissue.php?id=" . $row['id'] . "' class='edit-button'>Edit</a>";
                echo "<a href='deleteissue.php?id=" . $row['id'] . "' class='delete-button'>Delete</a>";
                echo "</td>";
                echo "<td>"; // New column for Admin Response
                echo "<a href='adminresponse.php' class='btn'>Admin Response</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // If no issues reported by the tenant, display a message
            echo "<p>No issues reported by you.</p>";
        }

        // Close database connection
        $pdo = null;
        ?>
    </div>
    <footer>
        <p>&copy; 2024 Gotham flow pro.</p>
    </footer>
</body>
</html>
