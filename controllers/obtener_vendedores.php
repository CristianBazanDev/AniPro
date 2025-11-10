<?php
require 'db.php';

$sql = "
    SELECT DISTINCT u.id, u.usuario
    FROM usuarios u
    INNER JOIN productos p ON u.id = p.id_vendedor
    WHERE p.activo = 1
    ORDER BY u.usuario ASC
";

$result = $conn->query($sql);

$vendedores = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $vendedores[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($vendedores);

$conn->close();
?>

