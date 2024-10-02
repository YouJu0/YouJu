<?php

session_start();
include '../conn.php';

if (!$mysqli) {
    echo json_encode(["error" => "Error en la conexión a la base de datos"]);
    exit();
}

if (!isset($_GET['forum_id'])) {
    echo json_encode(["error" => "ID del foro no proporcionado"]);
    exit();
}

$forumId = intval($_GET['forum_id']);
$query = "SELECT `Id_mensaje`, `Mensaje`, `Fecha_mensajes`, `Id_Usuario`
          FROM `mensajes` 
          WHERE `Id_Foro` = $forumId
          ORDER BY `Id_mensaje` DESC";

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
    $username = $userResult ? mysqli_fetch_assoc($userResult)['Nombre'] : "Desconocido";

    $messages[] = [
        'username' => htmlspecialchars($username),
        'message' => htmlspecialchars($row['Mensaje']),
        'created_at' => htmlspecialchars($row['Fecha_mensajes']),
    ];
}

header('Content-Type: application/json');
echo json_encode($messages);