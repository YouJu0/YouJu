<?php

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

// Verificar la ruta de autoload
require __DIR__ . '/../vendor/autoload.php';

$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new Chat()
    )
  ),
  8080 // Puerto del WebSocket
);

echo "Servidor WebSocket iniciado en el puerto 8080\n";
$server->run();
