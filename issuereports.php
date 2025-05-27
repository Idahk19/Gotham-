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
    list($year, $month) = explode('/', $_GET['month']);

    // Query to fetch reported issues for the selected month and year
    $stmt = $pdo->prepare("SELECT * FROM reported_issues WHERE YEAR(created_at) = ? AND MONTH(created_at) = ?");
    $stmt->execute([$year, $month]);
} else {
    // Query to fetch all reported issues if no month is selected
    $stmt = $pdo->query("SELECT * FROM reported_issues");
}

// PDF creation
$pdf = new FPDF();
$pdf->AddPage();

// Set font for the title
$pdf->SetFont('Arial', 'B', 16);

// Add logo
$pdf->Image('logo.png', 10, 10, 50);

// Calculate height of logo
$logoHeight = 50;

// Title
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, 'Gotham Apartments', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Reported Issues', 0, 1, 'C');

$pdf->Ln(10); // Add some space below the title

// Set font for table data
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($logoHeight + 15); // Set position below logo

// Table data
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(0, 10, 'Tenant Name: ' . $row['tenant_name'], 0, 1);
    $pdf->Cell(0, 10, 'Issue Description: ' . $row['issue_description'], 0, 1);
    $pdf->Cell(0, 10, 'Reported At: ' . $row['created_at'], 0, 1);
    $pdf->Ln(); // Add a line break between entries
}

// Output PDF
$pdf->Output('reported_issues_report.pdf', 'D');

// Close database connection
$pdo = null;
?>
