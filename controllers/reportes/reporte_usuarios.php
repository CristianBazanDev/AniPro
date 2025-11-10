<?php
session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../../index.php?error=2");
    exit;
}

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'usuarios';

if ($tipo === 'usuarios' || $tipo === 'vendedores' || $tipo === 'ventas') {
    if ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'seller') {
        header("Location: ../../index.php?error=2");
        exit;
    }
} elseif ($tipo === 'compras') {
    if ($_SESSION['rol'] !== 'user' && $_SESSION['rol'] !== 'admin') {
        header("Location: ../../index.php?error=2");
        exit;
    }
}

require '../db.php';
require('../../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

switch ($tipo) {
    case 'usuarios':
        $titulo = 'Reporte de Usuarios';
        $nombreArchivo = 'reporte_usuarios.pdf';
        $sql = "SELECT u.usuario, u.email, r.descripcion as rol
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id
                ORDER BY u.usuario";
        
        $result = $conn->query($sql);
        
        $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Usuario', 1);
        $pdf->Cell(80, 10, 'Email', 1);
        $pdf->Cell(50, 10, 'Rol', 1);
        $pdf->Ln();
        
        $pdf->SetFont('Arial', '', 10);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(60, 10, utf8_decode($row['usuario']), 1);
                $pdf->Cell(80, 10, utf8_decode($row['email'] ? $row['email'] : 'N/A'), 1);
                $pdf->Cell(50, 10, utf8_decode($row['rol']), 1);
                $pdf->Ln();
            }
        } else {
            $pdf->Cell(190, 10, 'No hay usuarios registrados', 1, 1, 'C');
        }
        break;
        
    case 'vendedores':
        $titulo = 'Reporte de Vendedores';
        $nombreArchivo = 'reporte_vendedores.pdf';
        $sql = "SELECT u.usuario, u.email, r.descripcion as rol
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id
                WHERE r.descripcion = 'seller' OR u.id_rol = 3
                ORDER BY u.usuario";
        
        $result = $conn->query($sql);
        
        $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Usuario', 1);
        $pdf->Cell(80, 10, 'Email', 1);
        $pdf->Cell(50, 10, 'Rol', 1);
        $pdf->Ln();
        
        $pdf->SetFont('Arial', '', 10);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(60, 10, utf8_decode($row['usuario']), 1);
                $pdf->Cell(80, 10, utf8_decode($row['email'] ? $row['email'] : 'N/A'), 1);
                $pdf->Cell(50, 10, utf8_decode($row['rol']), 1);
                $pdf->Ln();
            }
        } else {
            $pdf->Cell(190, 10, 'No hay vendedores registrados', 1, 1, 'C');
        }
        break;
        
    case 'ventas':
        $titulo = 'Reporte de Ventas';
        $nombreArchivo = 'reporte_ventas.pdf';
        
        $checkTable = $conn->query("SHOW TABLES LIKE 'ventas'");
        
        $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
        $pdf->Ln(10);
        
        if ($checkTable && $checkTable->num_rows > 0) {
            $sql = "SELECT v.id, v.fecha, u.usuario as vendedor, v.total, v.estado
                    FROM ventas v
                    LEFT JOIN usuarios u ON v.id_vendedor = u.id
                    ORDER BY v.fecha DESC";
            
            $result = $conn->query($sql);
            
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(20, 10, 'ID', 1);
            $pdf->Cell(50, 10, 'Fecha', 1);
            $pdf->Cell(60, 10, 'Vendedor', 1);
            $pdf->Cell(30, 10, 'Total', 1);
            $pdf->Cell(30, 10, 'Estado', 1);
            $pdf->Ln();
            
            $pdf->SetFont('Arial', '', 10);
            
            if ($result && $result->num_rows > 0) {
                $totalGeneral = 0;
                while ($row = $result->fetch_assoc()) {
                    $pdf->Cell(20, 10, $row['id'], 1);
                    $pdf->Cell(50, 10, utf8_decode($row['fecha']), 1);
                    $pdf->Cell(60, 10, utf8_decode($row['vendedor'] ? $row['vendedor'] : 'N/A'), 1);
                    $pdf->Cell(30, 10, '$' . number_format($row['total'], 2), 1);
                    $pdf->Cell(30, 10, utf8_decode($row['estado']), 1);
                    $pdf->Ln();
                    $totalGeneral += $row['total'];
                }
                $pdf->Ln(5);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(160, 10, 'Total General:', 1, 0, 'R');
                $pdf->Cell(30, 10, '$' . number_format($totalGeneral, 2), 1, 1);
            } else {
                $pdf->Cell(190, 10, 'No hay ventas registradas', 1, 1, 'C');
            }
        } else {
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Sistema de ventas no implementado', 0, 1, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 8, utf8_decode('El módulo de ventas aún no ha sido implementado.'), 0, 'L');
        }
        break;
        
    case 'compras':
        $titulo = 'Reporte de Compras';
        $nombreArchivo = 'reporte_compras.pdf';
        $usuario_actual = $_SESSION['usuario'];
        
        $checkTable = $conn->query("SHOW TABLES LIKE 'compras'");
        
        $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, utf8_decode('Cliente: ' . $usuario_actual), 0, 1, 'L');
        $pdf->Ln(5);
        
        if ($checkTable && $checkTable->num_rows > 0) {
            $sql = "SELECT c.id, c.fecha, c.total, c.estado
                    FROM compras c
                    INNER JOIN usuarios u ON c.id_usuario = u.id
                    WHERE u.usuario = ?
                    ORDER BY c.fecha DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $usuario_actual);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(30, 10, 'ID', 1);
            $pdf->Cell(60, 10, 'Fecha', 1);
            $pdf->Cell(50, 10, 'Total', 1);
            $pdf->Cell(50, 10, 'Estado', 1);
            $pdf->Ln();
            
            $pdf->SetFont('Arial', '', 10);
            
            if ($result && $result->num_rows > 0) {
                $totalGeneral = 0;
                while ($row = $result->fetch_assoc()) {
                    $pdf->Cell(30, 10, $row['id'], 1);
                    $pdf->Cell(60, 10, utf8_decode($row['fecha']), 1);
                    $pdf->Cell(50, 10, '$' . number_format($row['total'], 2), 1);
                    $pdf->Cell(50, 10, utf8_decode($row['estado']), 1);
                    $pdf->Ln();
                    $totalGeneral += $row['total'];
                }
                $pdf->Ln(5);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(140, 10, 'Total General:', 1, 0, 'R');
                $pdf->Cell(50, 10, '$' . number_format($totalGeneral, 2), 1, 1);
            } else {
                $pdf->Cell(190, 10, 'No hay compras registradas', 1, 1, 'C');
            }
        } else {
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Sistema de compras no implementado', 0, 1, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 8, utf8_decode('El módulo de compras aún no ha sido implementado. Este reporte estará disponible una vez que se configure la tabla de compras en la base de datos.'), 0, 'L');
        }
        break;
        
    default:
        header("Location: ../../index.php?error=3");
        exit;
}

$pdf->SetY(-30);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, utf8_decode('Generado el: ' . date('d/m/Y H:i:s')), 0, 0, 'C');

$pdf->Output('D', $nombreArchivo);
$conn->close();
