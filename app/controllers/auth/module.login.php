<?php
session_start();
include(__DIR__ . '/../connection/module.connection.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"], $_POST["pass"])) {
  $email = validarDatos($_POST["email"]);
  $pass = validarDatos($_POST['pass']);

  // Consulta segura utilizando declaraciones preparadas
  $stmt = $mysqli->prepare("SELECT * FROM `usuarios` WHERE `Email` = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $fila = $resultado->fetch_assoc();

  if ($fila && password_verify($pass, $fila['Contraseña'])) {
    // Validar estado del usuario y roles
    if ($fila['Id_rango'] == 3) { // Admin
      logear($fila);
    } elseif ($fila['Id_rango'] == 1 && $fila['User_Valido'] == 1 && $fila['Lista_N'] == 0) { // Usuario activo
      logear($fila);
    } elseif ($fila['Lista_N'] == 1) {
      redirigirConError("Ese usuario ha sido baneado.");
    } else {
      redirigirConError("Su cuenta debe ser validada.");
    }
  } else {
    redirigirConError("Usuario o contraseña incorrecta.");
  }
  $stmt->close();
} else {
  redirigirConError("Todos los campos son requeridos.");
}

function logear($user)
{
  $_SESSION['sesionMain'] = [
    'id' => $user['id'],
    'nombre' => $user['nombre'],
    'apellido' => $user['apellido'],
    'correo' => $user['Email'],
    'rango' => $user['Id_rango'],
  ];

  // Configurar cookies seguras
  setcookie("user", $_SESSION['sesionMain']["nombre"], [
    'expires' => time() + 9000,
    'httponly' => true,
    'secure' => true
  ]);
  header("Location: /"); // Redirigir al dashboard o página principal
  exit();
}

function redirigirConError($mensaje)
{
  header("Location: /login?error=" . urlencode($mensaje));
  exit();
}

function validarDatos($data)
{
  return htmlspecialchars(trim(stripslashes($data)));
}
