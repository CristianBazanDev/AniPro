<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require 'db.php';
require 'upload_image.php';

if (!isset($_POST['usuario'])) {
    die("Error: Falta el campo 'usuario' en el formulario");
}

if (!isset($_POST['password'])) {
    die("Error: Falta el campo 'password' en el formulario");
}

$usuario = $_POST['usuario'];
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password_plain = $_POST['password'];
$password = password_hash($password_plain, PASSWORD_DEFAULT);
$rol = isset($_POST['rol']) ? intval($_POST['rol']) : 3;
$profile_picture = null; // Se actualizará después de obtener el ID

$command = $conn->prepare("INSERT INTO usuarios (usuario, email, password, id_rol) VALUES (?, ?, ?, ?)");
if (!$command) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$command->bind_param("sssi", $usuario, $email, $password, $rol);

if ($command->execute()) {
    $user_id = $conn->insert_id;
    
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploaded_path = uploadProfilePicture($_FILES['profile_picture'], $user_id);
        if ($uploaded_path) {
            $profile_picture = $uploaded_path;
            
            $update_command = $conn->prepare("UPDATE usuarios SET profile_picture = ? WHERE id = ?");
            $update_command->bind_param("si", $profile_picture, $user_id);
            $update_command->execute();
        }
    } else {
        $default_image = './public/assets/img/profile_pictures/pp.webp';
        $update_command = $conn->prepare("UPDATE usuarios SET profile_picture = ? WHERE id = ?");
        $update_command->bind_param("si", $default_image, $user_id);
        $update_command->execute();
    }
    
    $rol_nombres = [1 => 'Administrador', 2 => 'Usuario', 3 => 'Vendedor'];
    $rol_nombre = isset($rol_nombres[$rol]) ? $rol_nombres[$rol] : 'Usuario';
    
    $_SESSION['usuario_creado'] = [
        'usuario' => $usuario,
        'email' => $email,
        'rol' => $rol_nombre,
        'password' => $password_plain
    ];
    
    header("Location: ../index.php?view=home&usuario_creado=1");
    exit;
} else {
    $_SESSION['error_usuario'] = "Error al ejecutar la consulta: " . $command->error . "<br>Error de conexión: " . $conn->error;
    header("Location: ../index.php?view=registro_usuario&error=1");
    exit;
}
