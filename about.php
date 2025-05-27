<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gotham Flo Pro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
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

        .main {
            padding: 20px;
            text-align: center;
            background-color: #f2f2f2;
            border-top: 4px solid #0074D9;
        }

        .section2 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section {
            margin-bottom: 40px;
        }

        h2 {
            color: #0074D9;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
            text-align: left;
        }

        footer {
            background-color: #0074D9;
            color: white;
            padding: 10px;
            text-align: center;
        }

        footer h3 {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="#">Gotham Flo Pro</a>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contactus.php">Contact</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>

    <div class="main">
        <div class="section2">
            <section>
                <div class="vision">
                    <h2>Vision:</h2>
                    <p>"To lead in transforming water management for Gotham Apartments, envisioning a future where water is used wisely, sustained responsibly, and benefits everyone."</p>
                </div>
            </section>
            <section>
                <div class="mission">
                    <h2>Mission:</h2>
                    <p>"At Gotham Flo Pro, we're dedicated to optimizing water use using smart tech and sustainable methods. We rigorously test water quality, detect leaks early, and use innovative strategies to improve water quality while being gentle on the environment. Our mission is rooted in efficiency, sustainability, and the goal of a future where water brings life and prosperity to all."</p>
                </div>
            </section>
            <section>
                <div class="responsibilities">
                    <h2>Our Responsibilities:</h2>
                    <ul>
                        <li>Maintain accurate records of water bills</li>
                        <li>Swiftly respond to reported leaks and implement efficient repair solutions.</li>
                        <li>Collaborate with maintenance teams to address underlying causes and prevent future leaks</li>
                        <li>Establish and maintain an efficient emergency response system.</li>
                        <li>Respond promptly to water-related emergencies and minimize potential damage.</li>
                        <li>Coordinate with relevant authorities and teams to ensure a swift and effective emergency resolution.</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <footer>
        <h3>&copy; <?php echo date("Y"); ?> Gotham Flow Pro</h3>
    </footer>
</body>
</html>
