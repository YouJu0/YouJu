<?php
session_start();
include("../../conexion.php");

// Verifica si la sesión está iniciada y si el usuario tiene permisos de administrador (Id_rango == 3)
if (!isset($_SESSION['sesionMain']) || $_SESSION['sesionMain']["Id_rango"] != 3) {
  echo json_encode(["error" => "No tienes permisos para eliminar mensajes"]);
  exit();
}

// Verifica que el parámetro 'idmsg' esté presente
if (!isset($_GET['idmsg'])) {
  echo json_encode(["error" => "ID del mensaje no proporcionado"]);
  exit();
}

$idMsg = intval($_GET['idmsg']);

// Consulta para actualizar el estado del mensaje
$query = "UPDATE `mensajes` SET `Validez_Mensaje` = 0 WHERE `Id_mensaje` = $idMsg";

if (mysqli_query($mysqli, $query)) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["error" => "Error al eliminar el mensaje: " . mysqli_error($mysqli)]);
}
