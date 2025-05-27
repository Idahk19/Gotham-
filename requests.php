<?php
// Backend Logic: Retrieving authorization requests
session_start(); // Start the session if not already started

// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=watermdb', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve authorization requests
$stmt = $pdo->query("SELECT * FROM authorization_requests");
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Approve request (assuming you have a request ID)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    $requestId = $_POST['request_id']; // Assuming request_id is sent via POST
    $stmt = $pdo->prepare("UPDATE authorization_requests SET authorized = 1 WHERE id = :request_id");
    $stmt->bindParam(':request_id', $requestId);
    $stmt->execute();
    // Redirect to refresh the page
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// Mark request as paid
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mark_as_paid'])) {
    $requestId = $_POST['request_id'];
    $stmt = $pdo->prepare("UPDATE authorization_requests SET status = 'Paid' WHERE id = :request_id");
    $stmt->bindParam(':request_id', $requestId);
    $stmt->execute();
    // Redirect to refresh the page
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization Requests</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #0074d9;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .action-btn {
            padding: 5px 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .action-btn:hover {
            background-color: #45a049;
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
    <h2>Authorization Requests</h2>
  
<p style="font-size: 20px; font-weight: bold;"> Go back to <a href='adminpagee.php' style="color: #4CAF50; text-decoration: none;">Admin Home</a></p>
<div class="reports">
<h3>Monthly report</h3>
<h4> To download a report for all tenants do not input a month </h4><br>
<form id="monthForm" action="depositreports.php" method="GET">
    <label for="months">Select a month and year:</label>
    <input type="text" id="months" name="months" placeholder="YYYY/MM">
    <button type="submit">Generate Report</button>
</form><br>

<table border="1">
        <tr>
            <th>Tenant ID</th>
            <th>Amount</th>
            <th>Month</th>
            <th>Status</th>
            <th>Action</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?php echo $request['tenant_name']; ?></td>
                <td><?php echo $request['amount']; ?></td>
                <td><?php echo $request['month']; ?></td>
                
                <td><?php echo $request['authorized'] ? 'Approved' : 'Pending'; ?></td>
                <td>
                    <?php if (!$request['authorized']): ?>
                        <form method="post">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                            <button type="submit" name="approve">Approve</button>
                        </form>
                    <?php endif; ?>
                </td>
                
                <td><?php echo $request['status'] == 'Paid' ? 'Paid' : 'Unpaid'; ?></td>
                <td>  
                    <?php if ($request['status'] != 'Paid'): ?>
                        <form method="post">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                            <button type="submit" name="mark_as_paid">Mark as Paid</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
