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
// Initialize $issue as an empty array
$issue = array();
// Check if the issue ID is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve the issue details based on the ID
    $issue_id = $_GET['id'];
    
    // Perform a database query to get the issue details based on $issue_id
    $query = "SELECT * FROM reported_issues WHERE id = $issue_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $issue = $result->fetch_assoc();
    } else {
        echo "Issue not found!";
    }
} else {
    // Issue ID not provided in the URL, handle the error
    echo "Issue ID is missing!";
}
// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolve Issue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        form {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
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

        /* Responsive styles */
        @media (max-width: 600px) {
            form, table {
                width: 90%;
                margin: 20px auto;
            }
        }

    </style>
</head>
<body>

<h1>Resolve Issue</h1>

<!-- Display issue details -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tenant Name</th>
        <th>Email</th>
        <th>Issue Type</th>
        <th>Issue Description</th>
        <th>Reported At</th>
    </tr>
    <tr>
        <td><?php echo $issue['id']; ?></td>
        <td><?php echo $issue['tenant_name']; ?></td>
        <td><?php echo $issue['email']; ?></td>
        <td><?php echo $issue['issue_type']; ?></td>
        <td><?php echo $issue['issue_description']; ?></td>
        <td><?php echo $issue['created_at']; ?></td>
    </tr>
</table>

<form action="reply.php?id=<?php echo $issue_id; ?>" method="post">
    <textarea name="reply" rows="4" cols="50" placeholder="Enter your reply here..."></textarea><br>
    <input type="submit" value="Submit Reply">
</form>

</body>
</html>


