<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
  protected $clients;

  public function __construct()
  {
    $this->clients = new \SplObjectStorage;
    echo "El servidor se inició correctamente\n ";
  }

  public function onOpen(ConnectionInterface $conn)
  {
    $this->clients->attach($conn);
    echo "Nueva conexión! ({$conn->resourceId})\n";
  }

  public function onMessage(ConnectionInterface $from, $msg)
  {
    $msgData = json_decode($msg, true); // Decodificar el mensaje recibido
    $i = 1;
    foreach ($this->clients as $client) {
      if ($from !== $client && $i == 1) {
        // Enviar el mensaje a todos los clientes conectados
        $client->send(json_encode([
          'usuario_name' => $msgData['usuario_name'],
          'mensaje' => $msgData['mensaje'],
          'created_at' => $msgData['created_at'] // Asegúrate de incluir este campo si está presente
        ]));
        echo "Mensaje enviado desde el usuario: {$from->resourceId} al usuario: {$client->resourceId}\n";
      }
      $i++;
    }
  }

  public function onClose(ConnectionInterface $conn)
  {
    $this->clients->detach($conn);
    echo "Conexión {$conn->resourceId} ha sido desconectada\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e)
  {
    echo "Ocurrió un error: {$e->getMessage()}\n";
    $conn->close();
  }
}
