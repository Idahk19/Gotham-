<?php
// Start a session
session_start();

// Check if the tenant is logged in
if (!isset($_SESSION['house_number']) || !isset($_SESSION['tenant_name'])) {
    // Redirect to the login page if not logged in
    header("Location: tenantlogin.php");
    exit();
}

// Database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'watermdb';

// Create a new PDF instance
require('fpdf.php');
$pdf = new FPDF('p','mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B', 12);

// Establish database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the water bill table for the logged-in tenant
$house_number = $_SESSION['house_number'];
$tenant_name = $_SESSION['tenant_name'];
$sql = "SELECT * FROM water_bills WHERE house_number = '$house_number'";
$result = $conn->query($sql);
// Check if there are results
if ($result->num_rows > 0) {
    // Output header and logo
    $pdf->Image('logo.png', 10, 10, 50);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Gotham Apartments', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Monthly Bill', 0, 1, 'C');
    $pdf->Ln(10); // Add some space below the logo

    // Output invoice details for the logged-in tenant in a table
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetX(10); // Set X position to align with the logo
    $pdf->SetY(70); // Set Y position to start below the logo

    $pdf->Cell(20, 7, 'House No', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Tenant Name', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Month', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Amount', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Amount Paid', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Arrears', 1, 1, 'C');

    while ($row = $result->fetch_assoc()) {
        $pdf->SetX(10); // Set X position to align with the logo
        $pdf->Cell(20, 7, $row['house_number'], 1, 0, 'C');
        $pdf->Cell(40, 7, $tenant_name, 1, 0, 'C');
        $pdf->Cell(30, 7, $row['month'], 1, 0, 'C');
        $pdf->Cell(25, 7, 'Ksh ' . $row['amount'], 1, 0, 'C');
        $pdf->Cell(25, 7, 'Ksh ' . $row['amount_paid'], 1, 0, 'C');
        $pdf->Cell(25, 7, 'Ksh ' . $row['arrears'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No invoices found for the current month.', 0, 1);
}

// Close database connection
$conn->close();

// Output the PDF as a download
$pdf->Output('D', 'monthly_invoices.pdf'); // D option: force download
