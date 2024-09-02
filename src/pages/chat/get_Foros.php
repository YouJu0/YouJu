<?php
session_start();
include("../../conexion.php");

// Verifica que el parámetro 'forum_id' esté presente
if (!isset($_GET['forum_id'])) {
    echo json_encode(["error" => "ID del foro no proporcionado"]);
    exit();
}

$forumId = intval($_GET['forum_id']);

// Consulta para obtener los mensajes del foro seleccionado
$query = "SELECT `Mensaje`, `Fecha_mensajes`, `Id_Usuario`,`Validez_Mensaje` FROM `mensajes` WHERE `Id_Foro` = $forumId ORDER BY `Fecha_mensajes` ASC";
$result = mysqli_query($mysqli, $query);

if (!$result) {
    echo json_encode(["error" => "Error al obtener los mensajes: " . mysqli_error($mysqli)]);
    exit();
}

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $userId = $row['Id_Usuario'];
    $userQuery = "SELECT `Nombre` FROM `usuarios` WHERE `Id_Usuario` = '$userId'";
    $userResult = mysqli_query($mysqli, $userQuery);

    if ($userResult) {
        $userRow = mysqli_fetch_assoc($userResult);
        $username = htmlspecialchars($userRow['Nombre']);
    } else {
        $username = "Desconocido";
    }

    $messages[] = [
        'username' => $username,
        'message' => htmlspecialchars($row['Mensaje']),
        'created_at' => htmlspecialchars($row['Fecha_mensajes']),
        'validez' => htmlspecialchars($row['Validez_Mensaje'])
    ];
}

echo json_encode($messages);
