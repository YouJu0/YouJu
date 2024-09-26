<?php
session_start();
require_once 'src/config/conexion.php'; // Asegúrate de que la conexión a la base de datos esté incluida

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Enrutamiento básico
switch ($requestUri) {
    case '/':
        include 'src/pages/home/index.php'; // Página de inicio
        break;

    case '/chat':
        include 'src/pages/chat/index.php'; // Página de chat
        break;

    case '/chat/get_Msg.php':
        include 'src/pages/chat/get_Msg.php'; // Obtener mensajes
        break;

    case '/chat/send_Msg.php':
        include 'src/pages/chat/send_Msg.php'; // Enviar mensajes
        break;

    case '/chat/eliminarMSG.php':
        include 'src/pages/chat/eliminarMSG.php'; // Eliminar mensajes
        break;

    case '/login':
        include 'src/pages/sesiones/login.php'; // Página de login
        break;

    case '/register':
        include 'src/pages/sesiones/register.php'; // Página de registro
        break;

    case '/admin':
        include 'src/pages/admin/panelAdmin.php'; // Panel de administración
        break;

    default:
        http_response_code(404);
        include 'src/pages/404.php'; // Página de error 404
        break;
}