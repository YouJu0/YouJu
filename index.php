<?php
session_start();
include 'src/controllers/conn.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Solo obtener la ruta sin parámetros de consulta
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Función para verificar rutas
function matchRoute($route) {
    global $requestUri;
    return preg_match('#^' . preg_quote($route, '#') . '\/?$#', $requestUri);
}

// Enrutamiento básico
switch (true) {
    case matchRoute('/'):
        include 'src/views/home/index.php';
        break;

    case matchRoute('/login'):
        include 'src/views/auth/login/index.php';
        break;

    case matchRoute('/register'):
        include 'src/views/auth/register/index.php';
        break;

    case matchRoute('/procesar/login'):
        include 'src/controllers/auth/login.php';
        break;

    case matchRoute('/procesar/register'):
        include 'src/controllers/auth/register.php';
        break;

    case matchRoute('/logout'):
        include 'src/controllers/auth/logout.php';
        break;

    case matchRoute('/business'):
        include 'src/views/business/index.php';
        break;

    case (preg_match('/^\/business\/(\d+)\/?$/', $requestUri, $matches) ? true : false):
        include 'src/views/business/[id].php';
        break;

    case matchRoute('/business/error'):
        include 'src/views/business/error.php';
        break;
    
    case (preg_match('/^\/business\/categoria\/(\d+)\/?$/', $requestUri, $matches) ? true : false):
        include 'src/views/business/category.php';
        break;

    case matchRoute('/controller/chat'):
        include 'src/controller/chat/chat.php';
        break;

    case matchRoute('/chat'):
        // Aquí manejamos los parámetros de consulta como 'user-name', 'forum-id', 'message'
        $userName = isset($_GET['user-name']) ? $_GET['user-name'] : null;
        $forumId = isset($_GET['forum-id']) ? $_GET['forum-id'] : null;
        $message = isset($_GET['message']) ? $_GET['message'] : null;

        // Ahora puedes procesar estos valores en tu vista o controlador
        include 'src/views/chat/index.php';
        break;

    case matchRoute('/chat/messages/get'):
        include 'src/controllers/chat/getMessage.php';
        break;

    case matchRoute('/chat/messages/send'):
        include 'src/controllers/chat/sendMessage.php';
        break;

    case matchRoute('/chat/messages/delete'):
        include 'src/controllers/chat/deleteMessage.php';
        break;

    case matchRoute('/controller/get-business'):
        include 'src/controllers/business/getBusinessList.php';
        break;

    default:
        http_response_code(404);
        include 'src/views/404.php'; // Página de error 404
        break;
}
