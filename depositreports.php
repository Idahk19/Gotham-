<?php
// Backend Logic: Retrieving authorization requests
session_start(); // Start the session if not already started

// Include FPDF library
require('fpdf.php');

// Establish database connection
$pdo = new PDO('mysql:host=localhost;dbname=watermdb', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve authorization requests based on selected month and year
if(isset($_GET['months']) && !empty($_GET['months'])) {
    list($year, $month) = explode('/', $_GET['months']);
   
    $stmt = $pdo->prepare("SELECT * FROM authorization_requests WHERE YEAR(`month`) = ? AND MONTH(`month`) = ?");
    $stmt->execute([$year, $month]);
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If no month is selected, retrieve all authorization requests
    $stmt = $pdo->query("SELECT * FROM authorization_requests");
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// PDF creation
$pdf = new FPDF();
$pdf->AddPage();

// Set font for the title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Authorization Requests Report', 0, 1, 'C');

// Set font for table headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Tenant ID', 1, 0, 'C');
$pdf->Cell(30, 10, 'Amount', 1, 0, 'C');
$pdf->Cell(30, 10, 'Month', 1, 0, 'C');
$pdf->Cell(30, 10, 'Status', 1, 0, 'C');
$pdf->Cell(30, 10, 'Payment Status', 1, 1, 'C');

// Set font for table data
$pdf->SetFont('Arial', '', 12);

foreach ($requests as $row) {
    $pdf->Cell(30, 10, $row['tenant_name'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['amount'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['month'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['authorized'] ? 'Approved' : 'Pending', 1, 0, 'C');
    $pdf->Cell(30, 10, $row['status'], 1, 1, 'C');
}

// Output PDF
$pdf->Output('authorization_requests_report.pdf', 'D');

// Close database connection
$pdo = null;
?>
