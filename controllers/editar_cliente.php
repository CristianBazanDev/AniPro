<?php 
require 'db.php'; 
require 'upload_image.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_POST['id'] ?? null; 
    $usuario = $_POST['usuario'] ?? null; 
    $email = $_POST['email'] ?? null; 
    $profile_picture = $_POST['profile_picture'] ?? null; 

    if (!$id || !$usuario || !$email) {
        die("Faltan datos"); 
    }

    if (isset($_FILES['profile_picture_file']) && $_FILES['profile_picture_file']['error'] === UPLOAD_ERR_OK) {
        $uploaded_path = uploadProfilePicture($_FILES['profile_picture_file'], $id);
        if ($uploaded_path) {
            $profile_picture = $uploaded_path;
        }
    }

    $query = "UPDATE usuarios SET usuario = ?, email = ?, profile_picture = ? WHERE id = ?"; 
    $command = $conn->prepare($query); 
    $command->bind_param("sssi", $usuario, $email, $profile_picture, $id);
    
    if ($command->execute()) {
        header("Location: ../index.php?view=usuarios"); 
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

} else {
    echo "Método no permitido";
}