<?php
session_start();
include '../conn.php';

// Verifica la conexión a la base de datos
if (!$mysqli) {
    echo json_encode(["error" => "Error en la conexión a la base de datos"]);
    exit();
}

// Verifica que el parámetro 'forum_id' esté presente
if (!isset($_GET['forum_id'])) {
    echo json_encode(["error" => "ID del foro no proporcionado"]);
    exit();
}

$forumId = intval($_GET['forum_id']);
$lastMessageId = isset($_GET['last_message_id']) ? intval($_GET['last_message_id']) : 0;
$loadMore = isset($_GET['load_more']) && $_GET['load_more'] == 'true';
$limit = 25;

// Consulta para obtener los mensajes del foro seleccionado
$query = $loadMore
    ? "SELECT `Id_mensaje`, `Mensaje`, `Fecha_mensajes`, `Id_Usuario`, `Validez_Mensaje`
       FROM `mensajes` 
       WHERE `Id_Foro` = $forumId AND `Id_mensaje` < $lastMessageId
       ORDER BY `Id_mensaje` DESC 
       LIMIT $limit"
    : "SELECT `Id_mensaje`, `Mensaje`, `Fecha_mensajes`, `Id_Usuario`, `Validez_Mensaje`
       FROM `mensajes` 
       WHERE `Id_Foro` = $forumId
       ORDER BY `Id_mensaje` DESC 
       LIMIT $limit";

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
        'validez' => htmlspecialchars($row['Validez_Mensaje']),
        'msgId' => htmlspecialchars($row['Id_mensaje'])
    ];
}

// Configura el encabezado para indicar que el contenido es JSON
header('Content-Type: application/json');
echo json_encode($messages);
