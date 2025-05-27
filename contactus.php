<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        footer {
    background-color: #0074D9;
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #00459a;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .contact-form {
            margin-top: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
            color: #00459a;
            font-weight: bold;
            font-size: 18px;
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea,
        .contact-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            font-size: 16px;
        }

        .contact-form input[type="submit"] {
            background-color: #00459a;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .contact-form input[type="submit"]:hover {
            background-color: #003366;
        }

        .contact-info {
            margin-top: 40px;
            border-top: 2px solid #00459a;
            padding-top: 20px;
        }

        .contact-info h2 {
            color: #00459a;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .contact-info p {
            margin-bottom: 10px;
            color: #333;
            font-size: 16px;
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

        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 26px;
                margin-bottom: 20px;
            }

            .contact-form label,
            .contact-form input[type="text"],
            .contact-form input[type="email"],
            .contact-form textarea,
            .contact-form select {
                font-size: 14px;
            }

            .contact-form input[type="submit"] {
                padding: 10px 16px;
                font-size: 14px;
            }

            .contact-info h2 {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .contact-info p {
                font-size: 14px;
            }
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
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contactus.php ">Contact</a></li>
                <li><a href="signup.php">SignUp</a></li>
            </ul>
        </nav>
    </header>


<div class="container">
    <h1>Contact Us</h1>
    
    <div class="contact-form">
    <form action="reporthandler.php" method="post">
        <label for="tenant_name">Your Name:</label>
        <input type="text" id="tenant_name" name="tenant_name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="issue_type">Issue Type:</label>
        <select id="issue_type" name="issue_type" required>
            <option value="bills issues">Bills issue</option>
            <option value="Repair issues">Repair Issue</option>
            <option value="other">Other</option>
        </select>

        <label for="issue_description">Issue Description:</label>
        <textarea id="issue_description" name="issue_description" required></textarea>

        <button type="submit">Submit</button>
    </form>
  
    </div>

    <div class="contact-info">
        <h2>Contact Information</h2>
        <p>Address: Gotham, Kiambu, Thika town, Runda estate</p>
        <p>Phone: 0757732215</p>
        <p>Email: info@gothamflopro.co.ke</p>
    </div>
</div>
<footer>
        <p>&copy; 2024 Gotham flow pro.</p>
    </footer>

</body>
</html>
