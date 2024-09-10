<?php
session_start();
include(__DIR__ . '/../connection/module.connection.php');

if (!isset($_SESSION['sesionMain'])) {
    echo json_encode(["error" => "No estás logueado"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = mysqli_real_escape_string($mysqli, $_POST['message']);
    $forumId = intval($_POST['forum_id']);
    $id = $_SESSION['sesionMain']['id'];

    $query = "INSERT INTO `mensajes` (`Id_Usuario`, `Mensaje`, `Fecha_mensajes`, `Id_Foro`, `Validez_Mensaje`)
              VALUES ('$id', '$message', NOW(), $forumId, 1)";

    if (!mysqli_query($mysqli, $query)) {
        echo json_encode(["error" => "Error al insertar el mensaje: " . mysqli_error($mysqli)]);
    } else {
        echo json_encode(["success" => "Mensaje enviado"]);
    }
} else {
    echo json_encode(["error" => "Método no permitido"]);
}
