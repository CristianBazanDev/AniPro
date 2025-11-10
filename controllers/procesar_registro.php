<?php
require 'db.php';

$usuario = $_POST['usuario'];
$clave = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = isset($_POST['rol']) ? intval($_POST['rol']) : 2; // Por defecto rol 2 (usuario)

$command = $conn->prepare("INSERT INTO usuarios (usuario, password, id_rol) VALUES (?, ?, ?)");
$command->bind_param("ssi", $usuario, $clave, $rol);

if ($command->execute()) {
    header("Location: ../pages/login.php?success=1");
    exit;
} else {
    header("Location: ../pages/registrar_cliente.php?error=1");
    exit;
}
