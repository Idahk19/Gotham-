<?php
// Start a session
session_start();

// Check if the tenant is logged in
if (!isset($_SESSION['house_number']) || !isset($_SESSION['tenant_name'])) {
    // Redirect to the login page if not logged in
    header("Location: tenantlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Your Bills</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #1565c0, #ffffff, #1565c0);
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
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            font-size: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #007bff; 
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3; /* Darker shade of blue on hover */
        }
        .total-arrears-container {
            margin-top: 20px;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        a {
            color: #007bff; /* Blue color for the link */
            text-decoration: none; /* Remove underline */
            font-weight: bold; /* Make the text bold */
            display: block; /* Change display to block */
            margin: 0; /* Remove default margin */
            margin-bottom: 10px; /* Add margin bottom for spacing */
        }
        
        a:hover {
            color: #0056b3; 
        }
        
        .action-btn {
    display: inline-block;
    background-color: #0074D9;
    color: #fff;
    padding: 5px 20px;
    text-decoration: none;
    border-radius: 5px;
}
.pay-btn {
    display: inline-block;
    background-color: #0074D9;
    color: #fff;
    padding: 5px 20px;
    text-decoration: none;
    border-radius: 5px;
}
.reports-btn {
    display: inline-block;
    background-color: #0074D9;
    color: #fff;
    padding: 5px 20px;
    text-decoration: none;
    border-radius: 5px;
}
.hero {
    background-color: #f2f2f2;
    padding:20px 0;
    text-align: center;
}
footer {
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

        @media only screen and (max-width: 600px) {
            .main {
                width: 90%;
            }
        }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Close the script tag for including jQuery -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    function makePayment(id, amount) {
        // Redirect to the payment page with the bill details
        window.location.href = 'pesa.php?id=' + id + '&amount=' + amount;
    }
    function requestDeposit(id, amount, month) {
    $.ajax({
        type: 'POST',
        url: 'request_deposit.php', // Your PHP script to handle the request
        data: { billId: id, amount: amount, month: month }, // Include the month parameter
        success: function(response) {
            alert(response); // Show response from the server (optional)
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log any errors to the console
        }
    });
}

</script>


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
                &nbsp;&nbsp;
                <li><a href="viewreports.php">My reported issues</a></li>
                &nbsp;&nbsp;
                <li><a href="contactus.php">Report Issues</a></li>
               
            </ul>
        </nav>
    </header>
<div class="main">
    
<p><b><a href='generatepdf.php'> Download Invoices</a><b></p>

    <?php
    

    // Your database connection logic here
    $pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");
// Check if the tenant_name is set in the session
if (isset($_SESSION['tenant_name']) && isset($_SESSION['house_number']))  {
    $loggedInTenant = $_SESSION['tenant_name'];
    $houseNumber = $_SESSION['house_number'];
    


        // Fetch tenant details
        $fetchTenantQuery = "SELECT * FROM tenants WHERE name = :name";
        $stmtTenant = $pdo->prepare($fetchTenantQuery);
        $stmtTenant->bindParam(':name', $loggedInTenant, PDO::PARAM_STR);
        $stmtTenant->execute();

        if ($stmtTenant->rowCount() > 0) {
            $tenantDetails = $stmtTenant->fetch(PDO::FETCH_ASSOC);

            // Fetch bills associated with this tenant using house_number
            $houseNumber = $tenantDetails['house_number'];
            $fetchBillsQuery = "SELECT * FROM water_bills WHERE house_number = :house_number";
            $stmtBills = $pdo->prepare($fetchBillsQuery);
            $stmtBills->bindParam(':house_number', $houseNumber, PDO::PARAM_INT);
            $stmtBills->execute();

            // Initialize a variable to store the total arrears
            $totalArrears = 0;

          
    

            // Display tenant details
            echo "<h2>Welcome, " . $loggedInTenant . "!</h2>";
            echo "<p><b> House Number: " . $houseNumber . "<b></p>";

            
            if ($stmtBills->rowCount() > 0) {
                // Display the bills
                echo "<h2>Your Bills</h2>";
                echo "<table>";
                echo "<tr><th>Month</th><th>Amount</th><th>Status</th><th>Amount Paid</th><th>Arrears</th></tr>";
                while ($row = $stmtBills->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['month'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>";
                    if ($row['paid'] !== NULL && $row['paid'] != 0) {
                        echo "Paid";
                    } else {
                        echo '<button class="action-btn" onclick="makePayment(' . $row['id'] . ', ' . $row['amount'] . ')">Make payment</button>';
                        echo '&nbsp;&nbsp;';
                        echo '<button class="action-btn" onclick="requestDeposit(' . $row['id'] . ', ' . $row['amount'] . ', \'' . $row['month'] . '\')">Make deposit request</button>';
                        }
                        echo "<td>" . $row['amount_paid'] . "</td>";
                        echo "<td>" . $row['arrears'] . "</td>";
                    echo "</td>";
                    echo "</tr>";

                        // Update total arrears
        $totalArrears += $row['arrears'];
                }
                echo "</table>";
            } else {
                echo "<p>No water bills found for House Number $houseNumber</p>";
            }

            // Display the total arrears in a separate div
            if ($totalArrears > 0) {
                echo "<div class='total-arrears-container'>";
                echo "<h2>Total Arrears</h2>";
                echo "Amount: Ksh " . number_format($totalArrears, 2); // Format as currency
                echo "</div>";
            }
        }
    } else {
        // If the session variable is not set, redirect to the login page
        header("Location: tenantlogin.php");
        exit();
    }

    // Close the database connection
    $pdo = null;
    ?>
   <section class="hero">
        <div class="hero-content">
        <a href="pesa.php" class="pay-btn">Pay</a>
    
               </div> <!-- Add the following script to your HTML file -->
      </section>
    </div>
    
    <script>
    var alertShown = false; // Flag to track if alert has been shown

function updateApprovals() {
    // Use AJAX to fetch new approved requests from the server
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            // Check if there are new approved requests
            if (response.approvedRequests && !alertShown) {
                // Check if the bill status is not paid
                if (response.billStatus !== 'paid') {
                    // Display an alert
                    alert('Deposit request approved!');
                    alertShown = true; // Set the flag to true only when a new approval is detected
                }
            }
        }
    };

    xhr.open('GET', 'check_approval.php', true);
    xhr.send();
}

    

    // Call updateApprovals function every 7 seconds
    setInterval(updateApprovals, 5000);
  
    document.addEventListener('DOMContentLoaded', function() {
    let alertShown = false; // Initialize the flag

    // Reset the flag and update the database when the user closes the alert
    window.addEventListener('click', function () {
        if (alertShown) {
            // Use Fetch API to update the database
            fetch('update authorized.php?action=updateAuthorized', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log('Database updated.');
            })
            .catch(error => {
                console.error('Error updating database:', error);
            });
            
            alertShown = false; // Reset the flag
        }
    });
});

</script>

<footer>
        <p>&copy; 2024 Gotham flow pro.</p>
    </footer>
</body>
</html>

