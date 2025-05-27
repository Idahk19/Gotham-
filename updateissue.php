<?php
session_start();

// Check if the tenant is logged in
if(!isset($_SESSION['tenant_name'])) {
    // Redirect to the login page if not logged in
    header("Location: tenantlogin.php");
    exit();
}

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if issue ID is provided in the URL
if(isset($_GET['id'])) {
    // Fetch the issue details from the database
    $stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $issue = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If issue ID is not provided, redirect to the reported issues page
    header("Location: tenantreportedissues.php");
    exit();
}

// Check if the issue belongs to the logged-in tenant
if($issue['tenant_name'] !== $_SESSION['tenant_name']) {
    // Redirect to the reported issues page if the issue does not belong to the tenant
    header("Location: tenantreportedissues.php");
    exit();
}

// Handle form submission to update the issue
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input fields (not shown here)
    
    // Update the issue in the database
    $stmt = $pdo->prepare("UPDATE reported_issues SET issue_description = ? WHERE id = ?");
    $stmt->execute([$_POST['issue_description'], $_GET['id']]);
    // Bill updated successfully, redirect to view all bills page
    echo "<script>alert('Issue updated successfully'); window.location.href = 'viewreports.php';</script>";
    
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Reported Issue</title>
    <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2{
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
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
    <h2>Edit Reported Issue</h2>
  
    <form method="post">
        <label for="issue_description">Issue Description:</label><br>
        <textarea id="issue_description" name="issue_description" rows="4" cols="50"><?php echo $issue['issue_description']; ?></textarea><br>
        <input type="submit" value="Update Issue">
    </form>
</body>
</html>

<?php
// Close database connection
$pdo = null;
?>
