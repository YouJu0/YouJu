<?php
include("/connection");

//verifica si los campos no estan vacios
if (
  isset($_POST["nombre"])
  && isset($_POST["apellido"])
  && isset($_POST["email"])
  && isset($_POST["pass"])
  && isset($_POST["confirmPass"])
  && isset($_POST["fecha_nacimiento"])
) {
  //cargo los datos en variables
  $name = validarRegistro($_POST["nombre"]);
  $apellido = validarRegistro($_POST["apellido"]);
  $email = validarRegistro($_POST["email"]);
  $pass = validarRegistro($_POST['pass']);
  $confpass = validarRegistro($_POST['confirmPass']);
  $fecha = validarRegistro($_POST['fecha_nacimiento']);
  //comprueba rango de edad
  if (rangoEdad($fecha)) {
    //verifica si las contraseñas coinciden
    if ($pass === $confpass) {
      //encripto la contrasenia
      $passcrypt = md5($pass);
      //guardo la querry en una variable
      $query = "INSERT INTO `usuarios` (`Id_Usuario`,`Nombre`,`Apellido`,`Contraseña`,`Email`,`Fecha_Nac`,`Lista_N`,`Id_rango`,`User_Valido`) 
            VALUES (null,'$name','$apellido','$passcrypt','$email','$fecha',0,1,0)";
      //intento la querry, si falla lo atrapo
      try {
        //carga el resultado en una variable  
        $resultado = $mysqli->query($query);
      } catch (\Throwable $th) {
        header("Location: /register?error=EL correo ya esta registrado o algo a ido mal");
        //Cierro la consulta y la conexion
        exit();
      } //verifico que la consulta se haga correctamente
      if ($resultado) {
        include("/controller/login");
        //Cierro la consulta y la conexion
        $resultado->close();
        exit();
      } //si la consulta falla se lo aviso con dos posibilidades
      else {
        header("Location: /register?error=EL correo ya esta registrado o no cumple los requisitos");
        exit();
      } //fin de condicion
    } //si la contraseña y la confirmacion de contraseñan no coinciden se lo aviso
    else {
      header("Location: /register?error=las contraseñas no coinciden");
      exit();
    } //fin de condicion
  } //Si esta por fuera de rango de edad se le inpide el registro
  else {
    //de no ser mayor muestra el msg
    header("Location: /register?error=Debe de tener entre 14 y 29 años para registrarse");
  } //fin de condicion
} //fin de condicion


//function para validar mayoria de edad
function rangoEdad($fecha)
{
  $min = 14;
  $max = 29;
  //establecemos la fecha
  $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
  //compruebo fecha actual y diferencia
  $calculo = $nacio->diff(new DateTime());
  //saco solo el año
  $edad = $calculo->y;
  //compruebo si no esta entre los rangos    
  if ($edad < $min || $edad > $max) {
    return false;
  } else {
    return true;
  }
}
//funcion para verificar los datos
function validarRegistro($datos)
{
  $datos = trim($datos);
  $datos = stripcslashes($datos);
  $datos = htmlspecialchars($datos);
  return $datos;
}
