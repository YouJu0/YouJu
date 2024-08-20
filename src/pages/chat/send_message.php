<?php
session_start(); // Inicia la sesión para usar las variables de sesión
include("../../conexion.php"); // Incluye el archivo de conexión a la base de datos

// Verificar si la sesión está activa
if (!isset($_SESSION['sesionMain'])) {
    // Si la sesión no está activa, devuelve un mensaje de error en formato JSON
    echo json_encode(["error" => "No estás logueado"]);
    exit(); // Termina el script si el usuario no está logueado
}

// Manejo de nuevos mensajes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el mensaje del formulario y lo escapa para evitar inyecciones SQL
    $message = mysqli_real_escape_string($mysqli, $_POST['message']);
    $id = $_SESSION['sesionMain']['id']; // Obtiene el ID del usuario desde la sesión

    // Consulta para insertar el nuevo mensaje en la base de datos
    $query = "INSERT INTO `mensajes` (`Id_Usuario`, `Mensaje`, `Fecha_mensajes`, `Id_Foro`, `Validez_Mensaje`)
              VALUES ('$id', '$message', NOW(), 1, 1)";

    if (!mysqli_query($mysqli, $query)) {
        // Si ocurre un error al insertar el mensaje, devuelve un mensaje de error en formato JSON
        echo json_encode(["error" => "Error al insertar el mensaje: " . mysqli_error($mysqli)]);
    } else {
        // Si el mensaje se inserta correctamente, devuelve un mensaje de éxito en formato JSON
        echo json_encode(["success" => "Mensaje enviado"]);
    }
} else {
    // Si el método de la solicitud no es POST, devuelve un mensaje de error en formato JSON
    echo json_encode(["error" => "Método no permitido"]);
}
?>
