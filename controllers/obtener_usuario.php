<?php 
require 'db.php'; 
$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400); 
    echo json_encode(["error" => "Falta el parámetro del id"]);
}

$query = "SELECT * FROM usuarios WHERE id = ?";
$command = $conn->prepare($query);
$command->bind_param("i", $id); 
$command->execute();
$result = $command->get_result();

if ($usuario = $result -> fetch_assoc()) {
    header('Content-Type: application/json'); 
    echo json_encode($usuario); 
} else {
    http_response_code(404); 
    echo json_encode(["error" => "Usuario no encontrado"]);
}
