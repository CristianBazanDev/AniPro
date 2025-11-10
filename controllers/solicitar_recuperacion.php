<?php
session_start();
require 'db.php';

$usuario = $_POST['usuario'] ?? '';

if (empty($usuario)) {
    header("Location: ../pages/forgot-password.php?error=1");
    exit;
}

$sql = "SELECT id FROM usuarios WHERE usuario = ?";
$command = $conn->prepare($sql);
$command->bind_param("s", $usuario);
$command->execute();
$result = $command->get_result();

if ($result->num_rows == 0) {
    header("Location: ../pages/forgot-password.php?error=1");
    exit;
}

$user = $result->fetch_assoc();
$userId = $user['id'];

$token = bin2hex(random_bytes(32));
$expira = date('Y-m-d H:i:s', strtotime('+1 hour')); 


$checkColumns = $conn->query("SHOW COLUMNS FROM usuarios LIKE 'reset_token'");
if ($checkColumns->num_rows == 0) {
    $conn->query("ALTER TABLE usuarios ADD COLUMN reset_token VARCHAR(64) NULL");
    $conn->query("ALTER TABLE usuarios ADD COLUMN reset_token_expira DATETIME NULL");
}


$sql = "UPDATE usuarios SET reset_token = ?, reset_token_expira = ? WHERE id = ?";
$command = $conn->prepare($sql);
$command->bind_param("ssi", $token, $expira, $userId);
$command->execute();


$resetLink = "http://" . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . "/pages/reset-password.php?token=" . $token;

header("Location: ../pages/forgot-password.php?token_sent=" . urlencode($resetLink));
exit;

