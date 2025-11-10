<?php
require 'db.php';

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
$tipo = isset($_GET['tipo']) ? trim($_GET['tipo']) : '';
$vendedor = isset($_GET['vendedor']) ? intval($_GET['vendedor']) : 0;

$sql = "
    SELECT 
        p.id,
        p.titulo,
        p.descripcion,
        p.precio,
        p.tipo,
        p.imagen_url,
        p.id_vendedor,
        p.fecha_creacion,
        u.usuario as nombre_vendedor
    FROM productos p
    INNER JOIN usuarios u ON p.id_vendedor = u.id
    WHERE p.activo = 1
";

$params = [];
$types = '';

if (!empty($busqueda)) {
    $sql .= " AND (p.titulo LIKE ? OR p.descripcion LIKE ?)";
    $search_param = "%{$busqueda}%";
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= 'ss';
}

if (!empty($tipo)) {
    $sql .= " AND p.tipo = ?";
    $params[] = $tipo;
    $types .= 's';
}

if ($vendedor > 0) {
    $sql .= " AND p.id_vendedor = ?";
    $params[] = $vendedor;
    $types .= 'i';
}

$sql .= " ORDER BY p.fecha_creacion DESC";

$command = $conn->prepare($sql);

if (!empty($params)) {
    $command->bind_param($types, ...$params);
}

$command->execute();
$result = $command->get_result();

$productos = [];

while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($productos);

$command->close();
$conn->close();
?>

