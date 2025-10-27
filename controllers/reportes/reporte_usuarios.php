<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php?error=2");
    exit;
}

require 'db.php';
require('/fpdf/fpdf.php');

$sql = "SELECT u.usuario, r.descripcion 
        FROM usuarios u
        INNER JOIN roles r ON u.id_rol = r.id";

$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Lista de Usuarios', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Usuario', 1);
$pdf->Cell(60, 10, 'Rol', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(60, 10, $row['usuario'], 1);
    $pdf->Cell(60, 10, $row['descripcion'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'productos.pdf');
