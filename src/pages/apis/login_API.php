<?php
session_start();
include("../../conexion.php");
if (isset($_POST["Email"]) && isset($_POST["Pass"])) {
  function validar($datos)
  {
    $datos = trim($datos);
    $datos = stripcslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
  }
  $Email = validar($_POST["Email"]);
  $pass = validar($_POST['Pass']);
  if (empty($Email)) {
    header("Location: index.php?error=El usuario es requerido");
    exit();
  } elseif (empty($pass)) {
    header("Location: index.php?error=La contraseña es requerida");
    exit();
  } else {
    $passcypt = sha1($pass);
    $resultado = $mysqli->query("SELECT * FROM `user` where `email` = '$Email' and `pass` = '$passcypt'");
    if ($resultado->num_rows === 1) {
      $fila = $resultado->fetch_row();
      if ($fila[2] === $Email && $fila[3] === $passcypt) {
        $datosSesion = array('ID' => $fila[0], 'Nombre' => $fila[1], 'Correo' => $fila[2], 'PassW' => $fila[3]);
        $_SESSION['sesionMain'] = $datosSesion;
        header("Location:../../index.php");
        $resultado->close();
        exit();
      } else {
        header("Location: ../login.php?error=el usuario o la contraseña es incorrecto 1 '$Email' '$passcypt'");
        $resultado->close();
        exit();
      }
    } else {
      header("Location: ../login.php?error=el usuario o la contraseña es incorrecto 2  '$Email' '$passcypt'");
      $resultado->close();
      exit();
    }
  }
} else {
  header("Location: ../login.php?error=los campos son obligatorios");
  $resultado->close();
  exit();
}
