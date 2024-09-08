<?php
header('Content-Type: application/json');

include("../../../conexion.php");

// Obtener el ID del usuario
$userId = intval($_GET['id']);

// Actualizar el estado del usuario
$sql = "UPDATE usuarios SET User_Valido = 1 WHERE Id_Usuario = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

$mysqli->close();
