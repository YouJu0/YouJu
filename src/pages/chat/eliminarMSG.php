<?php

include("../../../conexion.php");

// Obtener el ID del usuario
$idmsg = intval($_GET['idmsg']);

// Actualizar el estado del usuario
$sql = "UPDATE `mensajes` SET `Validez_Mensaje` = '0' WHERE `mensajes`.`Id_mensaje` = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $idmsg);

$response = [];
if ($stmt->execute()) {
  $response['success'] = true;
} else {
  $response['success'] = false;
}

echo json_encode($response);

$mysqli->close();
