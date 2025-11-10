<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] !== 'seller' && $_SESSION['rol'] !== 'admin')) {
    header("Location: ../index.php?view=home");
    exit;
}

$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? 0;
$tipo = $_POST['tipo'] ?? '';

$id_vendedor = $_SESSION['id'] ?? null;

if (!$id_vendedor && isset($_SESSION['usuario'])) {
    $sql_usuario = "SELECT id FROM usuarios WHERE usuario = ?";
    $command_usuario = $conn->prepare($sql_usuario);
    $command_usuario->bind_param("s", $_SESSION['usuario']);
    $command_usuario->execute();
    $result_usuario = $command_usuario->get_result();
    
    if ($row_usuario = $result_usuario->fetch_assoc()) {
        $id_vendedor = $row_usuario['id'];
        $_SESSION['id'] = $id_vendedor; 
    }
    $command_usuario->close();
}

if (empty($titulo) || empty($precio) || empty($tipo) || !$id_vendedor) {
    $error_msg = 'Por favor complete todos los campos requeridos';
    if (!$id_vendedor) {
        $error_msg .= ' (Error: No se pudo identificar al vendedor)';
    }
    $_SESSION['error_producto'] = $error_msg;
    header("Location: ../index.php?view=crear_producto");
    exit;
}

$imagen_url = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['imagen'];
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowed_types)) {
        $_SESSION['error_producto'] = 'Tipo de archivo no permitido';
        header("Location: ../index.php?view=crear_producto");
        exit;
    }
    
    if ($file['size'] > $max_size) {
        $_SESSION['error_producto'] = 'El archivo es demasiado grande (máx. 5MB)';
        header("Location: ../index.php?view=crear_producto");
        exit;
    }
    
    $upload_dir = __DIR__ . '/../public/assets/img/productos/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('producto_', true) . '.' . $extension;
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        $imagen_url = './public/assets/img/productos/' . $filename;
    } else {
        $_SESSION['error_producto'] = 'Error al subir la imagen';
        header("Location: ../index.php?view=crear_producto");
        exit;
    }
} else {
    $imagen_url = './public/assets/img/logo/logo.png';
}

$command = $conn->prepare("INSERT INTO productos (titulo, descripcion, precio, tipo, imagen_url, id_vendedor) VALUES (?, ?, ?, ?, ?, ?)");
$command->bind_param("ssdssi", $titulo, $descripcion, $precio, $tipo, $imagen_url, $id_vendedor);

if ($command->execute()) {
    $_SESSION['producto_creado'] = true;
    header("Location: ../index.php?view=tienda");
} else {
    $_SESSION['error_producto'] = 'Error al crear el producto: ' . $command->error;
    header("Location: ../index.php?view=crear_producto");
}

$command->close();
$conn->close();
?>

