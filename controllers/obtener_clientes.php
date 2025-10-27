<?php 
require 'db.php';

$command = "SELECT * FROM clientes";
$result = $conn->query($command);

$clientes = []; 

if ($result && $result->num_rows >0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($clientes); 