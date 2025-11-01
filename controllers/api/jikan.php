<?php
header('Content-Type: application/json');

$url = 'https://api.jikan.moe/v4/top/anime?filter=bypopularity&limit=21';

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
