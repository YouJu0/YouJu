<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
  protected $clients;
  private $mysqli;

  public function __construct()
  {
    $this->clients = new \SplObjectStorage;

    // Conexión a la base de datos
    $hostN = 'utuserver.giize.com';
    $port = "3306";
    $UserName = 'utu';
    $UserPass = 'utu2023';
    $DBname = 'chat_db';

    try {
      $this->mysqli = new \mysqli($hostN, $UserName, $UserPass, $DBname, $port);
      $this->mysqli->set_charset("utf8mb4");
    } catch (\mysqli_sql_exception $e) {
      error_log($e->getMessage());
      die('Error al conectar a la base de datos');
    }
  }

  public function onOpen(ConnectionInterface $conn)
  {
    // Nueva conexión
    $this->clients->attach($conn);
    echo "Nueva conexión: ({$conn->resourceId})\n";
  }

  public function onMessage(ConnectionInterface $from, $msg)
  {
    $data = json_decode($msg, true);

    if (isset($data['user_id'], $data['message'], $data['forum_id'])) {
      $userId = $data['user_id'];
      $message = $data['message'];
      $forumId = $data['forum_id'];

      // Guardar el mensaje en la base de datos
      $this->saveMessageToDatabase($userId, $forumId, $message);

      // Enviar el mensaje a todos los clientes conectados
      foreach ($this->clients as $client) {
        // Marcar el mensaje como nuevo
        $client->send(json_encode([
          'user_id' => $userId,
          'message' => $message,
          'forum_id' => $forumId,
          'new_message' => true // Indicar que es un mensaje nuevo
        ]));
      }
    }
  }

  public function onClose(ConnectionInterface $conn)
  {
    $this->clients->detach($conn);
    echo "Conexión cerrada: ({$conn->resourceId})\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e)
  {
    echo "Error: {$e->getMessage()}\n";
    $conn->close();
  }

  private function saveMessageToDatabase($userId, $forumId, $message)
  {
    try {
      $stmt = $this->mysqli->prepare("INSERT INTO messages (user_id, forum_id, message) VALUES (?, ?, ?)");
      $stmt->bind_param('iis', $userId, $forumId, $message);
      $stmt->execute();
      $stmt->close();
    } catch (\mysqli_sql_exception $e) {
      error_log('Error al guardar mensaje: ' . $e->getMessage());
    }
  }
}
