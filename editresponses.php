<?php
// edit_response.php

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Check if response ID is provided through GET method and is not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Assuming you have received the response ID through GET method
    $responseId = $_GET['id'];

    // Fetch the response from the database
    $stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE id = ?");
    $stmt->execute([$responseId]);
    $response = $stmt->fetch(PDO::FETCH_ASSOC);

    if($response) {
        // Display the form for editing
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Response</title>
            <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding:20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
        </style>
        </head>
        <body>
            <h1>Edit Response</h1>
            <form action="updateresponse.php" method="post">
                <!-- Display response data in the form for editing -->
                <input type="hidden" name="response_id" value="<?php echo $response['id']; ?>">
                <label for="response_status">Response Status:</label>
                <input type="text" id="response_status" name="response_status" value="<?php echo $response['status']; ?>"><br>
                <input type="submit" value="Update Response">
            </form>
        </body>
        </html
        <?php
    } else {
        // If response with provided ID is not found, redirect back to the view responses page
        header("Location: view_responses.php");
        exit();
    }
} else {
    // If response ID is not provided or invalid, redirect back to the view responses page
    header("Location: view_responses.php");
    exit();
}

// Close database connection
$pdo = null;
?>
