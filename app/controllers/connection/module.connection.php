<?php
$hostN = 'utuserver.giize.com';
$port = "3306";
$UserName = 'utu';
$UserPass = 'utu2023';
$DBname = 'youju';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $mysqli = new mysqli($hostN, $UserName, $UserPass, $DBname, $port);
    $mysqli->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());
    die('Error al conectar a la base de datos');
}

// error_reporting(0);
