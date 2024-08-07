<?php
$hostN = 'localhost';
$UserName = 'root';
$UserPass = '';
$DBname = 'cuentas';
$mysqli =  new mysqli($hostN, $UserName, $UserPass, $DBname);
if ($mysqli->connect_errno) {die(''. $mysqli->connect_error);}