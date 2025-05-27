
<!DOCTYPE html>
<html>
<head>
    <title>Admin Responses</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        h2 {
            text-align: center;
            

        }

        .admin-responses-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-response {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .admin-response p {
            margin: 10px 0;
            font-size: 16px;
        }

        .admin-response p strong {
            font-weight: bold;
            color: #007bff;
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
        .edit-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 10px;
        }
        .delete-button:hover {
            background-color: #0056b3;
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
        .admin-response {
    border: none; 
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
</div>
<br>
<h2>Your Responses</h2>

<p style="font-size: 20px; font-weight: bold;"> Go back to <a href='adminpagee.php' style="color: #4CAF50; text-decoration: none;">Admin Home</a></p>

<div class="admin-responses-container">
    <?php

    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

    // Fetch all responses
    $stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE status IS NOT NULL AND status != ''");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='admin-response'>";
            echo "<h4><strong>Name:</strong>  " . $row['tenant_name'] . "</h4>"."</br>";
            echo "<h4><strong>Issue:</strong> " . $row['issue_description'] . "</h4>"."</br>";
            echo "<h4><strong>Response:</strong>  " . $row['status'] . "</h4>"."</br>";
    echo "<a href='editresponses.php?id=" . $row['id'] . "' class='edit-button'>Edit</a>";
    echo "<a href='deleteresponse.php?id=" . $row['id'] . "' class='delete-button' onclick=\"return confirm('Are you sure you want to delete?')\">Delete</a>";

            echo "</div>";
        }
    } else {
        echo "<p>No admin responses found.</p>";
    }

    // Close database connection
    $pdo = null;
    ?>
</div>

</body>
</html>
