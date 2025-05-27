<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Services</title> <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    font-family: Arial, sans-serif;
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

.hero {
    background-color: #f2f2f2;
    padding: 100px 0;
    text-align: center;
}

.hero-content h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.hero-content p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.btn {
    display: inline-block;
    background-color: #0074D9;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.about {
    background-color: #fff;
    padding: 50px 0;
    text-align: center;
}

.about-content h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.about-content p {
    font-size: 1.2rem;
}

.services {
    background-color: #f2f2f2;
    padding: 50px 0;
    text-align: center;
}

.services-content h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.services-content ul {
    list-style: none;
}

.services-content ul li {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

footer {
    background-color: #0074D9;
    color: #fff;
    text-align: center;
    padding: 20px 0;
}
button{
    width: 200px;
    padding: 15px 0;
    text-align: center;
    margin: 20px 10px;
    border-radius: 25px;
    font-weight: bold;
    border: 2px solid rgb(11, 132, 231);
    background: transparent;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    color: #fff;
}
span{
    background: rgb(11, 132, 231);
    height: 100%;
    width: 0;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: -1;
    transition: 0.5s;
}

button:hover span{
    width: 100%;
}

button:hover{
    border: none;
}
.logins {
            display: flex;
            justify-content: center;
            align-items: center;
        
        }

.services-logins {
            text-align: center;
        }
         dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
</style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="#">Gotham flow pro</a>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contactus.php ">Contact</a></li>
                <li><a href="signup.php">SignUp</a></li>
                
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Gotham flow pro</h1>
            <p>Providing reliable water solutions</p>
            <a href="learnmore.php" class="btn">Learn More</a>
        </div>
    </section>
<section class="services">
        <div class="services-content">
            <h2>Our Services</h2>
            <ul>
                <li>Water bills integrity</li>
                <li>Water issues report platform</li>
                <li>Water Conservation</li>
                <li>Water Quality Testing</li>
            </ul>
        </div>
    </section>
    <section class="logins">
        <div class="services-logins">
        <div>

<button type="button"><span></span><a href="adminlogin.php">Admin LogIn</a></button>
<button type="button"><span></span><a href="tenantlogin.php">Tenant LogIn</a></button>

</div>

</div>
    </section>
 <footer>
        <p>&copy; 2024 Gotham flow pro.</p>
    </footer>
</body>
</html>
