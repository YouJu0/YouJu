<?php
$hostN = 'utuserver.duckdns.org:3306';
$UserName = 'utu';
$UserPass = 'utu2023';
$DBname = 'youju';
$mysqli =  new mysqli($hostN, $UserName, $UserPass, $DBname);
if ($mysqli->connect_errno) {
    die('algo fallo' . $mysqli->connect_error);
}
