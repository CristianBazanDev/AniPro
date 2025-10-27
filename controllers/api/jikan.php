<?php
header('Content-Type: application/json');

$url = 'https://api.jikan.moe/v4/anime?page=1&limit=20';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if(curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => curl_error($ch)]);
    exit;
}

curl_close($ch);

echo $response;
