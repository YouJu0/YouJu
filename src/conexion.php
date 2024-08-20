<?php
$hostN = 'localhost';
$UserName = 'root';
$UserPass = '';
$DBname = 'youju';
$mysqli =  new mysqli($hostN, $UserName, $UserPass, $DBname);
if ($mysqli->connect_errno) {
    die('algo fallo' . $mysqli->connect_error);
}
