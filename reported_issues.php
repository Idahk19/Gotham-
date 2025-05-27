<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('homeimage.JPEG');
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8);
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #0074d9;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a.btn {
            background-color: #0074d9;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
        }

        a.btn:hover {
            background-color: #0056b3;
        }

        .main {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
            margin: 5px auto;
            width: 80%;
            text-align: center;
        }
        p {
            margin: 10px 0;
            text-align: center; 
        } .navbar {
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

    </style>
</head>
<body><div class="navbar">
    <a class="active" href="tenantsregistered.php">View registered users</a>
    <a href="bill_insert.php">Insert bills</a>
    <a class="active" href="adminviewbills.php">View and edit Bills</a>
    <a href="reported_issues.php" >View reported issues</a>
    <a class="active" href="adminviewresponses.php">View your issue responses</a>
    <a href="requests.php">View deposit requests</a>
</div>

    <h2>Reported Issues</h2>
    <p style="font-size: 20px; font-weight: bold;"> Go back to <a href='adminpagee.php' style="color: #4CAF50; text-decoration: none;">Admin Home</a></p>
    <div class="reports">
<h3>Monthly report</h3>
<h4> To download a report for all issues do not input a month </h4><br>
<form id="monthForm" action="issuereports.php" method="GET">
    <label for="month">Select a month and year:</label>
    <input type="text" id="month" name="month" placeholder="YYYY/MM">
    <button type="submit">Generate Report</button>
</form><br>
    <div class="main">
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

        // Fetch reported issues
        $query = "SELECT * FROM reported_issues";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Tenant Name</th>
                        <th>Email</th>
                        <th>Issue Type</th>
                        <th>Issue Description</th>
                        <th>Reported At</th>
                        <th>Action</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['tenant_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['issue_type']}</td>
                        <td>{$row['issue_description']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <a href='resolve.php?id={$row['id']}' class='btn'>Reply</a>
                        </td>
                    </tr>";
            }

            echo "</table>"; // Close the table
        } else {
            echo "No reported issues found.";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</body>
</html>

