<?php
session_start();//recuperation du pseudo dans la variable de séssion
$json_response = json_encode($_SESSION['user']['pseudo']);

echo $json_response;

?>