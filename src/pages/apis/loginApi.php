<?php
session_start();
//para poder llamarlo
include("../../conexion.php");
include("../../tools/crypter.php");

if (isset($_POST["email"]) && isset($_POST["pass"])) {
  function validarLogin($datos)
  {
    $datos = trim($datos);
    $datos = stripcslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
  }
  $email = validarLogin($_POST["email"]);
  $pass = validarLogin($_POST['pass']);
  if (empty($email)) {
    header("Location:../login.php?error=El usuario es requerido");
    exit();
  } elseif (empty($pass)) {
    header("Location:../login.php?error=La contraseña es requerida");
    exit();
  } else {
    $passcrypt = encryption($pass);
    $resultado = $mysqli->query("SELECT * FROM `user` where `email` = '$email' and `pass` = '$passcrypt'");
    if ($resultado->num_rows === 1) {
      $fila = $resultado->fetch_row();
      if ($fila[2] === $email && $fila[3] === $passcrypt) {
        $datosSesion = array('id' => $fila[0], 'nombre' => $fila[1], 'correo' => $fila[2], 'password' => $fila[3], 'role' => $fila[4]);
        $_SESSION['sesionMain'] = $datosSesion;
        header("Location:../../index.php");
        $resultado->close();
        exit();
      } else {
        header("Location:../login.php?error=El usuario o la contraseña es incorrecto");
        $resultado->close();
        exit();
      }
    } else {
      header("Location:../login.php?errorEl usuario o la contraseña es incorrecto");
      $resultado->close();
      exit();
    }
  }
} else {
  header("Location: ../login.php?error=los campos son obligatorios");
  $resultado->close();
  exit();
}
  //}function
