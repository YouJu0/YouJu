<?php
session_start();
include 'src/controllers/conn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Enrutamiento básico
switch ($requestUri) {
    case '/':
        include 'src/views/home/index.php'; // Página de inicio
        break;

    case '/chat':
        include 'src/views/chat/index.php'; // Página de chat
        break;

    case '/login':
        include 'src/views/auth/login/index.php'; // Página de login
        break;

    case '/register':
        include 'src/views/auth/register/index.php'; // Página de registro
        break;
    case '/procesar/login':
        include 'src/controllers/auth/login.php'; // Página de registro
        break;
    case '/procesar/register':
        include 'src/controllers/auth/register.php'; // Página de registro
        break;
    case '/session-close':
        include 'src/controllers/auth/session-close.php';
        break;

    
    


    default:
        http_response_code(404);
        include 'src/views/404.php'; // Página de error 404
        break;
}