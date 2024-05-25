<?php
require_once("../../conexion.php");
require_once("../../tools/crypter.php");

// Verifica si los campos no están vacíos
if (
  isset($_POST["email"]) &&
  isset($_POST["password"]) &&
  isset($_POST["confirmPassword"]) &&
  isset($_POST["name"])
) {
  // Función para validar los datos
  function validarRegistro($datos)
  {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
  }

  // Cargar los datos en variables
  $name = validarRegistro($_POST['name']);
  $email = validarRegistro($_POST["email"]);
  $password = validarRegistro($_POST['password']);
  $confirmPassword = validarRegistro($_POST['confirmPassword']);

  // Verifica si las contraseñas son iguales
  if ($password === $confirmPassword) {
    // Encripta la contraseña
    $passcrypt = encryption($password);

    // Inicia la consulta
    $stmt = $mysqli->prepare("INSERT INTO `user` (`Name`, `email`, `pass`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $passcrypt);

    // Ejecuta la consulta y da un resultado
    if ($stmt->execute()) {
      include("./loginApi.php");
      $stmt->close();
      exit();
    } else {
      header("Location: ../register.php?error=El correo ya está registrado o no cumple los requisitos");
      exit();
    }
  } else {
    header("Location: ../register.php?error=Las contraseñas no coinciden");
    exit();
  }
}

// Verifica qué campo está vacío y muestra un mensaje
if (empty($_POST["email"])) {
  header("Location: ../register.php?error=El correo es requerido");
  exit();
} elseif (empty($_POST["password"])) {
  header("Location: ../register.php?error=La contraseña es requerida");
  exit();
} elseif (empty($_POST["name"])) {
  header("Location: ../register.php?error=El nombre es requerido");
  exit();
}
