<?php
require 'db.php';

$usuario = $_POST['usuario'];
$clave = password_hash($_POST['password'], PASSWORD_DEFAULT);

$command = $conn->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
$command->bind_param("ss", $usuario, $clave);

if ($command->execute()) {
    header("Location: ../index.php?success=1");
} else {
    echo "Error: " . $command->error;
}
