<?php
header('Content-Type: application/json');

include("../../../conexion.php");

$query = "SELECT `Id_emprendimientos`, `Nombre_Emprendimiento`, `Id_Usuario`,`Id_categoria` FROM `emprendimientos` WHERE Emprendimiento_valido = 0";
$result = $mysqli->query($query);

$emprendimiento = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emprendimiento[] = $row;
    }
}

echo json_encode($emprendimiento);

$mysqli->close();