<?php
$hostN = 'utuserver.duckdns.org';
$port = "3306";
$UserName = 'utu';
$UserPass = 'utu2023';
$DBname = 'youju';

$mysqli = new mysqli($hostN, $UserName, $UserPass, $DBname, $port);
if ($mysqli->connect_errno) {
    die('algo fallo' . $mysqli->connect_error);
}

error_reporting(0); // Desactiva la visualización de errores