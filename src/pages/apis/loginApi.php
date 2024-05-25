<?php
require_once("../../conexion.php");
require_once("../../tools/crypter.php");

// Verifica si los campos están vacíos
if (isset($_POST["email"]) && isset($_POST["password"])) {
  // Función para validar los datos
  function validarLogin($datos)
  {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
  }

  // Cargar los datos en variables
  $email = validarLogin($_POST["email"]);
  $password = validarLogin($_POST['password']);

  // Verifica si los campos están vacíos
  if (empty($email)) {
    header("Location:../login.php?error=El correo es requerido");
    exit();
  } elseif (empty($password)) {
    header("Location:../login.php?error=La contraseña es requerida");
    exit();
  } else {
    // Encripta la contraseña utilizando la función del archivo crypter.php
    $passcrypt = encryption($password);

    // Consulta la base de datos usando declaraciones preparadas
    $stmt = $mysqli->prepare("SELECT * FROM `user` WHERE `email` = ? AND `pass` = ?");
    $stmt->bind_param("ss", $email, $passcrypt);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica el resultado de la consulta
    if ($resultado->num_rows === 1) {
      $fila = $resultado->fetch_assoc();
      // Crea la sesión si las credenciales son correctas
      $datosSesion = array(
        'id' => $fila['ID_User'],
        'nombre' => $fila['Name'],
        'correo' => $fila['email'],
        'password' => $fila['pass']
      );
      $_SESSION['sesionMain'] = $datosSesion;
      header("Location:../../index.php");
      $stmt->close();
      exit();
    } else {
      header("Location:../login.php?error=El usuario o la contraseña es incorrecto");
      $stmt->close();
      exit();
    }
  }
} else {
  header("Location: ../login.php?error=Los campos son obligatorios");
  exit();
}
