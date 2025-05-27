
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
            margin-top: 20px;
            font-size: 25px;
            
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
    <h2>Admin Responses</h2>
    <div class="admin-responses-container">
        <?php
        // Start the session
        session_start();

        // Check if the tenant is logged in
        if (!isset($_SESSION['tenant_name'])) {
            // Redirect to the login page if not logged in
            header("Location: tenantlogin.php");
            exit();
        }

        // Database connection
        $pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

        // Fetch tenant name based on logged-in tenant's name
        $tenantName = $_SESSION['tenant_name'];

        // Fetch admin responses for the current tenant
        $stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE tenant_name = :tenant_name AND status IS NOT NULL AND status != ''");
        $stmt->bindParam(':tenant_name', $tenantName, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='admin-response'>";
                echo "<p><strong>Name:</strong> " . $row['tenant_name'] . "</p>";
                echo "<p><strong>Issue:</strong> " . $row['issue_description'] . "</p>";
                echo "<p><strong>Response:</strong> " . $row['status'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No admin responses found for $tenantName.</p>";
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
