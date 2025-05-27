<?php
// Include FPDF library
require('fpdf.php');

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "watermdb";
$conn = new mysqli($hostname, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected month from the URL (assuming it's passed as a parameter named 'month')
$selectedMonth = $_GET['date']; // You might need to validate and sanitize this input

// Fetch data for the selected month from the database
// Fetch data for the selected month from the database
$query = "SELECT * FROM water_bills WHERE MONTH(month) = MONTH('$selectedMonth')";

$result = $conn->query($query);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();


$pdf->Image('logo.png', 10, 10, 50);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Gotham Apartments', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Monthly Bills', 0, 1, 'C');
$pdf->Ln(10); // Add some space below the logo

$pdf->Ln(20); // Add space below the title

// Add table headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Bill ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Amount', 1, 0, 'C');
$pdf->Cell(40, 10, 'House Number', 1, 0, 'C');
$pdf->Cell(40, 10, 'Month', 1, 1, 'C');
// Add table data
$pdf->SetFont('Arial', '', 12);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['amount'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['house_number'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['month'], 1, 1, 'C');
}

// Output PDF
$pdf->Output();
