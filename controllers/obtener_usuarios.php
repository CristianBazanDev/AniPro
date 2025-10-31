<?php 
require 'db.php';

$command = "SELECT * FROM usuarios";
$result = $conn->query($command);

$usuarios = []; 

if ($result && $result->num_rows >0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($usuarios); 