<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Signup</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #1565c0, #ffffff, #1565c0);
    margin: 0;
    padding: 0;
}

h2 {
    color: #333;
}

.container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.section2 {
    text-align: center;
    padding: 20px;
    background-color: white;
    max-width: 400px; 
    width: 100%; 
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: auto; 
}

.form {
    margin-top: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 8px;
    box-sizing: border-box;
    border-radius: 20px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
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

@media (max-width: 600px) {
    .section2 {
        max-width: 100%;
    }
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
<header>
        <nav>
            <div class="logo">
                <a href="#">Gotham flo pro</a>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contactus.php ">Contact</a></li>
                <li><a href="signup.php">SignUp</a></li>
            </ul>
        </nav>
    </header>
<br>
    <div class="section2">
                    <h2>Tenant Signup</h2>
                    <form name="login"  method="post" action="signuphandler.php" onsubmit="return validateLoginForm()">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required><br><br>
                        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required><br><br>
                        
                        <label for="house_number">House Number:</label>
                        <input type="text" id="house_number" name="house_number" required><br><br>
                        <P> Have an account?<a href="tenantlogin.php">LogIn <a> <p><br>
                        <input type="submit" value="Sign Up">
                    </form>
    </div>
       
</body>
</html>
