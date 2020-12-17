<?php
session_start();
$json_response = json_encode($_SESSION['user']['pseudo']);
// $json_image = json_encode($_SESSION['user']['img']);
echo $json_response;
// echo $json_image;
?>