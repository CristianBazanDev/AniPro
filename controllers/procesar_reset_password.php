<?php
session_start();
require 'db.php';

$token = $_POST['token'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

if (empty($token) || empty($password) || empty($password_confirm)) {
    header("Location: ../pages/reiniciar-contrasenia.php?token=" . urlencode($token) . "&error=1");
    exit;
}

if ($password !== $password_confirm) {
    header("Location: ../pages/reiniciar-contrasenia.php?token=" . urlencode($token) . "&error=1");
    exit;
}

$sql = "SELECT id FROM usuarios WHERE reset_token = ? AND reset_token_expira > NOW()";
$command = $conn->prepare($sql);
$command->bind_param("s", $token);
$command->execute();
$result = $command->get_result();

if ($result->num_rows == 0) {
    header("Location: ../pages/login.php?error=token_invalido");
    exit;
}

$user = $result->fetch_assoc();
$userId = $user['id'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET password = ?, reset_token = NULL, reset_token_expira = NULL WHERE id = ?";
$command = $conn->prepare($sql);
$command->bind_param("si", $hashedPassword, $userId);

if ($command->execute()) {
    header("Location: ../pages/reiniciar-contrasenia.php?token=" . urlencode($token) . "&success=1");
    exit;
} else {
    header("Location: ../pages/reiniciar-contrasenia.php?token=" . urlencode($token) . "&error=1");
    exit;
}

