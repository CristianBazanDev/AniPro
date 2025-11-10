<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?view=contacto");
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$asunto = $_POST['asunto'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje)) {
    $_SESSION['error_contacto'] = 'Por favor complete todos los campos requeridos';
    header("Location: ../index.php?view=contacto");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_contacto'] = 'Por favor ingrese un email válido';
    header("Location: ../index.php?view=contacto");
    exit;
}


$_SESSION['contacto_enviado'] = true;
$_SESSION['contacto_nombre'] = htmlspecialchars($nombre);

header("Location: ../index.php?view=contacto&success=1");
exit;
?>

