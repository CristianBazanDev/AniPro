<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: pages/login.php");
    exit;
}

$title = "Proyecto Anipro";

$page = $_GET['view'] ?? 'home';

$file = __DIR__ . "/views/$page.php";

if (file_exists($file)) {
    ob_start();
    include $file;
    $content = ob_get_clean();
} else {
    $content = "<h2>404 - Página no encontrada</h2>";
}

include __DIR__ . "/views/layout.php";

