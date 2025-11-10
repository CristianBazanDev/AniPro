<?php
require 'db.php';

$usuario = $_POST['usuario'];
$clave = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = isset($_POST['rol']) ? intval($_POST['rol']) : 3;


$command = $conn->prepare("INSERT INTO usuarios (usuario, password, id_rol) VALUES (?, ?)");
$command->bind_param("ss", $usuario, $clave, $rol);

if ($command->execute()) {
    header("Location: ../index.php?success=1");
} else {
    echo "Error: " . $command->error;
}
