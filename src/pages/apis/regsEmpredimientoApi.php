<?php
session_start();

include("../../conexion.php");
include("../../tools/crypter.php");
//verifica si los campos no estan vacios
if (
  isset($_POST["nombre"])
  && isset($_POST["nombreEmprendimiento"])
  && isset($_POST["categorias"])
  && isset($_POST["numeroDeContacto"])
  && isset($_POST["descripcionDeEmprendimiento"])
  ){
    //cargo los datos en variables
    $nombre = validarRegistro($_POST["nombre"]);
    $nombreEmprendimiento = validarRegistro($_POST["nombreEmprendimiento"]);
    $categoria = validarRegistro($_POST["categorias"]);
    $numContacto = validarRegistro($_POST['numeroDeContacto']);
    $descripcionDeEmprendimiento = validarRegistro($_POST['descripcionDeEmprendimiento']);
    $redesS1 = validarRegistro($_POST['redSocial1']);
    $redesS2 = validarRegistro($_POST['redSocial2']);
    $ubicacion = validarRegistro($_POST['ubicacion']);

    $email1 =  $_SESSION['sesionMain']['correo'];
    $queryCorreo = "select `Id_Usuario` from usuarios where `Email` = '$email1'";

    try {
      $resultadoCorreo = $mysqli->query($queryCorreo);
      $filaCorreo = $resultadoCorreo->fetch_row();
    } catch (\Throwable $th) {
      echo "". $th->getMessage() ."";
      closeALL($resultadoCorreo);
    }

    $query2 = "INSERT INTO `emprendimientos` (`Id_emprendimientos`,`Nombre_Emprendimiento`,`Id_Usuario`,`Id_categoria`,`Num_contacto`,`Descripcion`,`RedSocial1`,`RedSocial2`,`Ubicacion`,`Emprendimiento_valido`)
    VALUES (null,'$nombreEmprendimiento','$filaCorreo[0]','$categoria','$numContacto','$descripcionDeEmprendimiento','$redesS1','$redesS2','$ubicacion',0)";

    try {

      $resultado = $mysqli->query($query2);

    } catch (\Throwable $th) {
      header("Location: ../registerEmpredimiento.php?error=Algo a ido mal, solo se puede tener un apartado por usuario");
      closeALL($resultado);
      closeALL($resultadoCorreo);
       }
      if ($resultado) {
        $query3 = "SELECT `Id_emprendimientos`,`Nombre_Emprendimiento`,`Id_categoria`,`Emprendimiento_valido` 
        FROM `emprendimientos` WHERE `Id_Usuario` = $filaCorreo[0]";
        try {
           $resultado3 = $mysqli->query($query3);
           $fila3 = $resultado3->fetch_row();
          }catch (\Throwable $th) {
           echo "". $th->getMessage() ."";
           closeAllPLUS($resultado,$resultadoCorreo,$resultado3);
          }
          sessionEmprendimiento($fila3);
        header("Location: ../../index.php?error=Se registro correctamente su emprendimiento,para validarlo dirigirse a la oficina de la joventud, ubicado en el parque");
        //Cierro la consulta y la conexion
        closeAllPLUS($resultado,$resultadoCorreo,$resultado3);
        }//si la consulta falla se lo aviso con dos posibilidades
        else {
          header("Location: ../register.php?error=EL usuario ya tiene un emprendimiento registrado o no cumple los requisitos");
          closeAllPLUS($resultado,$resultadoCorreo,$resultado3);
          }//fin de condicion
            }//si la contraseña y la confirmacion de contraseñan no coinciden se lo aviso
            else {
              header("Location: ../register.php?error=Todos los campos son obligatorios");
              exit();
            }//fin de condicion




function sessionEmprendimiento($fila3){ 
   $datosSesion = array('identificador' => $fila3[0],'nombreEmprendimiento' => $fila3[1],'categoria' => $fila3[2],'validacionEmprendimiento' => $fila3[3]);
  $_SESSION['datosEmprendimiento'] = $datosSesion;}



  
function closeAllPLUS($resultado,$resultadoCorreo,$resultado3){
  closeALL($resultado);
  closeALL($resultadoCorreo);
  closeALL($resultado3);
}
    //funcion para verificar los datos
    function validarRegistro($datos)
    {
      $datos = trim($datos);
      $datos = stripcslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }