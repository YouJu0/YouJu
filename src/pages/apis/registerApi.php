<?php
include("../../conexion.php");
include("../../tools/crypter.php");

//verifica si los campos no estan vacios
if (
  isset($_POST["email"])
  && isset($_POST["pass"])
  && isset($_POST["confirmPass"])
  && isset($_POST["email"])
) {
  //funcion para verificar los datos
  function validarRegistro($datos)
  {
    $datos = trim($datos);
    $datos = stripcslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
  }
  //cargo los datos en variables
  $name = validarRegistro($_POST['name']);
  $email = validarRegistro($_POST["email"]);
  $pass = validarRegistro($_POST['pass']);
  $confpass = validarRegistro($_POST['confirmPass']);
  //verifica si las contraseñas coinciden
  if ($pass === $confpass) {
    //comienza la query
    $passcrypt = encryption($pass);
    $query = "INSERT INTO `user` (`ID_User`, `Name`, `email`, `pass`) 
        VALUES (NULL, '$name', '$email', '$passcrypt');";
    //carga el resultado en una variable
    $resultado = $mysqli->query($query);
    //si se crea correctamente te hace iniciar sesion
    if ($resultado) {
      include("./loginApi.php");
      $resultado->close();
      exit();
    } else {
      header("Location: ../register.php?error=EL correo ya esta registrado o no cumple los requisitos");
      exit();
    }
  } else {
    header("Location: ../register.php?error=Las contraseñas no coinciden");
    $resultado->close();
    exit();
  }
}
//verifica que campo esta vacio y muestra un mensaje
if (empty($email)) {
  header("Location:../register.php?error=El usuario es requerido");
  exit();
} elseif (empty($pass)) {
  header("Location:../register.php?error=La contraseña es requerida");
  exit();
} elseif (empty($name)) {
  header("Location:../register.php?error=El nombre es requerida");
  exit();
}
