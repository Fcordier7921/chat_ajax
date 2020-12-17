<?php
session_start();
$json_image = json_encode($_SESSION['user']['img']);
echo $json_image;
?>