
<?php
// Start the session
session_start();

// Function to authenticate users
function authenticate($username, $password) {
    // Your authentication logic goes here
    // Check if the username and password match from the database
    // Return true if authentication succeeds, false otherwise
    return ($username === "admin" && $password === "password"); // Example - replace with your actual authentication logic
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Authenticate the user
    if (authenticate($username, $password)) {
        // Authentication successful, set session variable
        $_SESSION['admin_logged_in'] = true;

        // Redirect to the admin page
        header('Location: adminpagee.php');
        exit();
    } else {
        // Authentication failed, redirect back to the login page with an error message
        $_SESSION['login_error'] = "Incorrect username or password.";
        header('Location: adminlogin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateLoginForm() {
            var username = document.forms["login"]["username"].value;
            var password = document.forms["login"]["password"].value;
            
            // Username validation (letters and numbers allowed)
            var nameRegex = /^[a-zA-Z0-9]+$/;
            if (!name.match(usernameRegex)) {
                alert("Username must contain only letters and numbers.");
                return false;
            }

            // Password validation (at least one uppercase, one lowercase, one number, and minimum length of 8 characters)
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            if (!password.match(passwordRegex)) {
                alert("Password must contain at least one uppercase letter, one lowercase letter, one number, and be at least 8 characters long.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Log In</h2>
        <form name="login"  method="post" action="LoginAHandler.php" onsubmit="return validateLoginForm()">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Log In">
        </form>
    </div>
</body>
</html>

