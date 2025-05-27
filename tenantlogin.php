<!DOCTYPE html>
<html>
<head>
    <title>Tenant Login</title>
    <style>
        body {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #1565c0, #ffffff, #1565c0);
        }

        .form-container {
            position: relative;
            width: 20%;
        }

        form {
            background: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           
            margin-top: 50px;
            
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 30px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        
    </style>
    <script>
        function validateLoginForm() {
            var name = document.forms["login"]["name"].value;
            var password = document.forms["login"]["password"].value;
            
            // Username validation (letters and numbers allowed)
            var nameRegex = /^[a-zA-Z0-9]+$/;
            if (!name.match(nameRegex)) {
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

<div class="form-container">
    
    <form name="login" method="post"  action="Tloginhandler.php" onsubmit="return validateLoginForm()">
        <label>Name:</label>
        <input type="name" name="name" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <label>House Number:</label>
        <input type="text" name="house_number" required>
        <br>
        <P> Dont have an account?<a href="signup.php">sign up <a> <p><br>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
