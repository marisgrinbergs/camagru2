<?php
$img = $_POST['data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);

$fileName = 'photo.png';
file_put_contents($fileName, $fileData);

$data = $img;

//header('Content-Type: application/json');

echo $data;
?>