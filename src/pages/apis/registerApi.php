<?php
include("../../conexion.php");
include("../../tools/crypter.php");

//verifica si los campos no estan vacios
if (
  isset($_POST["name"])
  && isset($_POST["pass"])
  && isset($_POST["confirmPass"])
  && isset($_POST["email"])
  && isset($_POST["fecha_nacimiento"])
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
    $fecha = validarRegistro($_POST['fecha_nacimiento']);
//vuelvo a verificar que ningun campo esta vacio
if (empty($email)) {
  header("Location:../register.php?error=El usuario es requerido");
  exit();
} elseif (empty($pass)) {
  header("Location:../register.php?error=La contraseña es requerida");
  exit();
} elseif (empty($name)) {
  header("Location:../register.php?error=El nombre es requerida");
  exit();
} elseif (empty($fecha)) {
  header("Location:../register.php?error=La fecha es requerida");
}
//comprueba mayoria de edad
if (rangoEdad($fecha)) {
  //verifica si las contraseñas coinciden
  if ($pass === $confpass) {
    //mando el correo de validacion
  //  $msg = rand(1000, 9999);
  //compruebo que se mando bien
  //  if(mail($email,"codigo de verificacion",$msg,"Att: Equipo de YouJu, esperamos que la pases genial en la web :D")){
  //    }else{echo"fallo al enviar el correo";} 
    //compruebo que lo ponga bien
 //   if ($_POST["code"] === $msg) {
      //encripto la contrasenia
    $passcrypt = encryption($pass);
    //guardo la querry en una variable
    $query = "INSERT INTO `user` (`ID_user`, `name`, `email`, `pass`,`fechaNacimiento`) 
      VALUES (NULL, '$name', '$email', '$passcrypt','$fecha');";
    //intento la querry, si falla lo atrapo
    try {
      //carga el resultado en una variable  
    $resultado = $mysqli->query($query);
              }catch (\Throwable $th) {
      header("Location: ../register.php?error=EL correo ya esta registrado o algo a ido mal");
        }
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
    header("Location: ../register.php?error=el codigo es incorrecto");
    $resultado->close();
    exit();
  }
}
}else{
  //de no ser mayor muestra el msg
  header("Location: ../register.php?error=Debe ser mayor de edad");
}
//}
//function para validar mayoria de edad
function rangoEdad ($fecha)
{
    $min= 14 ;
    $max = 29;
    //Creamos objeto fecha desde los valores recibidos
    $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
    //Calculamos usando diff y la fecha actual
    $calculo = $nacio->diff(new DateTime());
    //Obtenemos la edad
    $edad = $calculo->y;    
    if ($edad < $min || $edad > $max) 
    {
        return false;  
     }else{
        return true;  
    }
}

?>