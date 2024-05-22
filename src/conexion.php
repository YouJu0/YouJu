<?php
$hostN = 'localhost';
$UserName = 'root';
$UserPass = '';
$DBname = 'cuentas';
$mysqli =  new mysqli($hostN, $UserName, $UserPass, $DBname);

if ($mysqli->connect_errno) {
  header("Location: index.php?error=fallo en la conexion");
  exit();
} else {
  header("Location: index.php?error=conexion exitosa");
}
