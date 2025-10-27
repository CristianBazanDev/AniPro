<?php 
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_POST['id'] ?? null; 
    $nombre = $_POST['nombre'] ?? null; 
    $email = $_POST['email'] ?? null; 
    $profile_picture = $_POST['profile_picture'] ?? null; 

    if (!$id || !$nombre || !$email) {
        die("Faltan datos"); 
    }

    $query = "UPDATE clientes SET nombre = ?, email = ?, profile_picture = ? WHERE id = ?"; 
    $command = $conn->prepare($query); 
    $command-> bind_param("sssi", $nombre, $email, $profile_picture, $id);
    
    if ($command->execute()) {
        header("Location: ../index.php?view=clientes"); 
        exit;
    }else {
        echo "Error al actualizar: " . $conn->error;
    }

}else {
    echo "Método no permitido";
}