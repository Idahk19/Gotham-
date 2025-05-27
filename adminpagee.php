

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .slide-menu {
    height: 100%;
    width: 250px; /* Set initial width */
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}


        .slide-menu a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .slide-menu a:hover {
            color: #f1f1f1;
        }

        .slide-btn {
            position: fixed;
            left: 10px;
            top: 10px;
            font-size: 30px;
            cursor: pointer;
            color: #818181;
            z-index: 2;
        }
        .welcome-container {
            text-align: center;
            padding: 50px;
            margin-top: 10%;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
        }
        #welcome-container {
            text-align: center;
            padding: 20px;
            background-color: #0074d9;
            color: white;
        }

        #image-container {
            text-align: center;
            padding: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<div class="welcome-container">
        <h1>Welcome Admin! Check the menu <br><br> Go back to <a href='home.php'>Home Page</a></h1>
        
    </div>

    <div class="slide-menu" id="slideMenu">
    <a href="tenantsregistered.php" onclick="closeSlideMenu()">View registered users</a>
        <a href="bill_insert.php" onclick="closeSlideMenu()">Insert bills</a>
        <a href="adminviewbills.php" onclick="closeSlideMenu()">View and edit Bills</a>
        <a href="reported_issues.php" onclick="closeSlideMenu()">View repoted issues </a>
        <a href="adminviewresponses.php" onclick="closeSlideMenu()">View your issue responses </a>
        <a href="requests.php" onclick="closeSlideMenu()">View deposit requests</a>
    </div>

    <div class="slide-btn" onclick="openSlideMenu()">
        <i class="fas fa-bars"></i>
    </div>
    <div id="image-container">
        <img src="adminimg.png" alt="image not found">
    </div>

    <script>
        function openSlideMenu() {
            document.getElementById('slideMenu').style.width = '150px';
        }

        function closeSlideMenu() {
            document.getElementById('slideMenu').style.width = '0';
        }

        var alertShown = false; // Flag to track if alert has been shown

function updateApprovals() {
    // Use AJAX to fetch new approved requests from the server
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            // Check if there are new approved requests
            if (response.newIssues && !alertShown) {
                // Check if the bill status is not paid
                 
                    // Display an alert
                    alert('New issues reported!');
                    alertShown = true; // Set the flag to true only when a new approval is detected
                
            }
        }
    };

    xhr.open('GET', 'new_issues.php', true);
    xhr.send();
}

    

    // Call updateApprovals function every 7 seconds
    setInterval(updateApprovals, 7000);


</script>


</body>
</html>
