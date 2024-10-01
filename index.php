<?php
session_start();
include 'src/controllers/conn.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Enrutamiento básico
switch ($requestUri) {
    case '/':
        include 'src/views/home/index.php';
        break;

    case '/login':
        include 'src/views/auth/login/index.php';
        break;

    case '/register':
        include 'src/views/auth/register/index.php';
        break;
    case '/procesar/login':
        include 'src/controllers/auth/login.php';
        break;
    case '/procesar/register':
        include 'src/controllers/auth/register.php';
        break;
    case '/session-close':
        include 'src/controllers/auth/session-close.php';
        break;


        // Chat

        case '/chat':
            include 'src/views/chat/index.php';
            break;
    case '/chat/messages/get':
        include 'src/controllers/chat/getMessage.php';
        break;
    case '/chat/messages/send':
        include 'src/controllers/chat/sendMessage.php';
        break;
    case '/chat/messages/delete'  :
        include 'src/controllers/chat/deleteMessage.php';
        break;  
    


    default:
        http_response_code(404);
        include 'src/views/404.php'; // Página de error 404
        break;
}