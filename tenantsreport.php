<?php
// Start session
session_start();

// Include FPDF library
require('fpdf.php');

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=watermdb", "root", "");

// Fetch reports for the selected month and year
if(isset($_GET['month']) && !empty($_GET['month'])) {
    // Split the month and year from the input
    list($month, $year) = explode('/', $_GET['month']);

    // Query to fetch tenant information for the selected month and year
    $stmt = $pdo->prepare("SELECT * FROM tenants WHERE MONTH(created_at) = ? AND YEAR(created_at) = ?");
    $stmt->execute([$month, $year]);
} else {
    // Query to fetch all tenant information if no month is selected
    $stmt = $pdo->query("SELECT * FROM tenants");
}

// PDF creation
$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('logo.png', 10, 10, 50);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Gotham Apartments', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Tenants Report', 0, 1, 'C');

$pdf->Ln(10); // Add some space below the logo

// Set font for table headers
$pdf->SetFont('Arial', 'B', 12);

$pdf->SetX(10); // Set X position to align with the logo
$pdf->SetY(70); // Set Y position to start below the logo

// Table headers
$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Name', 1, 0, 'C');
$pdf->Cell(60, 10, 'Email', 1, 0, 'C'); // Adjusted width for email column
$pdf->Cell(30, 10, 'House Number', 1, 0, 'C');
$pdf->Cell(40, 10, 'Created At', 1, 1, 'C');

// Set font for table data
$pdf->SetFont('Arial', '', 12);

// Table data
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20, 10, $row['tenant_id'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['name'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['email'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['house_number'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['created_at'], 1, 1, 'C');
}

// Output PDF
$pdf->Output('registered_tenants_report.pdf', 'D');

// Close database connection
$pdo = null;
?>
