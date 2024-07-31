<?php
//compruebo si tiene sesion
if (isset($_SESSION['sesionMain'])) {
    //guardo tanto el nombre como el correo
    $name_user = $_SESSION['sesionMain']["nombre"];
    $correo_user = $_SESSION['sesionMain']["correo"];
}else{
    header("Location: ../../../index.php?error=Para poder hablar por el foro debe de estar logeado");
}
include("../../conexion.php");
    //guardo los msg en una variable 
    $var_PHP = "<script> document.writeln(m); </script>"; // igualar el valor de la variable JavaScript a PHP 

    $query = "INSERT INTO `user` (`ID_user`, `name`, `email`, `pass`,`fechaNacimiento`) 
    VALUES (NULL, '$name', '$email', '$passcrypt','$fecha');";
            //intento la querry, si falla lo atrapo
    try {
            //carga el resultado en una variable  
        $resultado = $mysqli->query($query);
        }catch (\Throwable $th) {
        header("Location: ../register.php?error=EL correo ya esta registrado o algo a ido mal");
  }