<?php
session_start();
include("../../conexion.php");

// Verifica la conexión a la base de datos
if (!$mysqli) {
    echo json_encode(["error" => "Error en la conexión a la base de datos"]);
    exit();
}

// Verifica que el parámetro 'forum_id' y 'offset' estén presentes
if (!isset($_GET['forum_id']) || !isset($_GET['offset'])) {
    echo json_encode(["error" => "ID del foro o offset no proporcionado"]);
    exit();
}

$forumId = intval($_GET['forum_id']);
$offset = intval($_GET['offset']);
$limit = 25; // Número de mensajes a recuperar

// Consulta para obtener los mensajes del foro seleccionado con paginación
$query = "SELECT `Id_mensaje`, `Mensaje`, `Fecha_mensajes`, `Id_Usuario`, `Validez_Mensaje`
          FROM `mensajes` 
          WHERE `Id_Foro` = $forumId 
          ORDER BY `Id_mensaje` DESC     
          LIMIT $limit OFFSET $offset";
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
