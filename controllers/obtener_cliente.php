<?php 
require 'db.php'; 
$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400); 
    echo json_encode(["error" => "Falta el parámetro del id"]);
}

$query = "SELECT * FROM clientes WHERE id = ?";
$command = $conn->prepare($query);
$command->bind_param("i", $id); 
$command->execute();
$result = $command->get_result();

if ($cliente = $result -> fetch_assoc()) {
    header('Content-Type: application/json'); 
    echo json_encode($cliente); 
} else {
    http_response_code(404); 
    echo json_encode(["error" => "Cliente no encontrado"]);
}
