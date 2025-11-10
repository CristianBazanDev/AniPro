<?php

require 'db.php';

$checkColumn = $conn->query("SHOW COLUMNS FROM usuarios LIKE 'profile_picture'");

if ($checkColumn->num_rows == 0) {
    $sql = "ALTER TABLE usuarios ADD COLUMN profile_picture VARCHAR(255) NULL DEFAULT NULL AFTER email";
    
    if ($conn->query($sql)) {
        echo "Campo 'profile_picture' agregado exitosamente a la tabla 'usuarios'<br>";
    } else {
        echo "Error al agregar el campo: " . $conn->error;
    }
} else {
    echo "El campo 'profile_picture' ya existe en la tabla ";
}

$conn->close();
?>

