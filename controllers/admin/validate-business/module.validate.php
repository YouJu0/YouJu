<?php
header('Content-Type: application/json');

include("../../../conexion.php");

// Obtener el ID del usuario
$emprendId = intval($_GET['id']);

// Actualizar el estado del usuario
$sql = "UPDATE emprendimientos SET Emprendimiento_valido = 1 WHERE Id_emprendimientos = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $emprendId);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

$mysqli->close();
?>
