<?php
 // Inicia la sesión para usar las variables de sesión
session_start();
// Incluye el archivo de conexión a la base de datos
include("../../conexion.php"); 

// Consulta para obtener los mensajes, ordenados por fecha descendente
$query = "SELECT `Mensaje`, `Fecha_mensajes`, `Id_Usuario` FROM `mensajes` ORDER BY `Fecha_mensajes` ASC";
// Ejecuta la consulta
$result = mysqli_query($mysqli, $query); 

if (!$result) {
    // Si hay un error en la consulta, devuelve un mensaje de error en formato Json
    echo json_encode(["error" => "Error al obtener los mensajes: " . mysqli_error($mysqli)]);
    exit(); 
}
 // Array para almacenar los mensajes
$messages = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Consulta para obtener el nombre del usuario a partir de su ID
    $userId = $row['Id_Usuario'];
    $userQuery = "SELECT `Nombre` FROM `usuarios` WHERE `Id_Usuario` = '$userId'";
    $userResult = mysqli_query($mysqli, $userQuery);
    
    if ($userResult) {
        // Si la consulta es exitosa, obtiene el nombre del usuario
        $userRow = mysqli_fetch_assoc($userResult);
        $username = htmlspecialchars($userRow['Nombre']);
    } else {
        // Si ocurre un error, asigna "Desconocido" como nombre de usuario
        $username = "Desconocido";
    }

    // suma el mensaje al array de mensajes
    $messages[] = [
        'username' => $username,
        'message' => htmlspecialchars($row['Mensaje']),
        'created_at' => htmlspecialchars($row['Fecha_mensajes'])
    ];
}

// Devuelve los mensajes en formato JSON
echo json_encode($messages);

