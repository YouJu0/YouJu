<?php
header('Content-Type: application/json');

include("../../../conexion.php");

$query = "SELECT Id_Usuario, Nombre, Apellido, Email FROM usuarios WHERE User_Valido = 1";
$result = $mysqli->query($query);

$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

$mysqli->close();