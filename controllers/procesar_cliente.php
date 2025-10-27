<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require 'db.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];

$command = $conn->prepare("INSERT INTO clientes (nombre, email) VALUES (?, ?)");
$command->bind_param("ss", $nombre, $email);

if ($command->execute()) {
    echo "Cliente registrado. <a href='./index.php?view=home'>Volver</a>";
} else {
    echo "Error: " . $command->error;
}
