<?php
session_start();
require 'db.php';

$usuario = $_POST['usuario'];
$clave = $_POST['password'];

// Traemos el hash de la pass + el rol
$sql = "
    SELECT u.password, u.id_rol, r.descripcion 
    FROM usuarios u
    INNER JOIN roles r ON u.id_rol = r.id
    WHERE u.usuario = ?
";

$command = $conn->prepare($sql);
$command->bind_param("s", $usuario);
$command->execute();
$command->store_result();

if ($command->num_rows == 1) {
    $command->bind_result($hash, $idRol, $descripcionRol);
    $command->fetch();

    if (password_verify($clave, $hash)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id_rol'] = $idRol;
        $_SESSION['rol'] = $descripcionRol; 
        header("Location: ../index.php?view=home");
        exit;
    }
}

// Si no pasa la validación
header("Location: index.php?error=1");
exit;

