<?php
session_start();
//para poder llamarlo
include("../../conexion.php");
include("../../tools/crypter.php");
//compruebo si los campos estan seteados
if (isset($_POST["email"]) && isset($_POST["pass"])) {
  //cargo los datos validados en variables
  $email = validarLogin($_POST["email"]);
  $pass = validarLogin($_POST['pass']);
  //encripto la contraseña
  $passcrypt = encryption($pass);
  //creo la query
  $Qlogin = "SELECT * FROM `usuarios` where `Email` = '$email' and `Contraseña` = '$passcrypt'";
  //hago la consulta y la cargo en un array
  $resultado = $mysqli->query($Qlogin);
  $fila = $resultado->fetch_row();
  //en caso de ser admin te manda al panel admin
  if ($resultado->num_rows === 1 && $fila[7] == 3) {
    header("Location:../admin/panelAdmin.php");
    CloseALL($resultado);
  } //compruebo si hay resultados
  if ($resultado->num_rows === 1 && $fila[7] == 1) {
    //compruebo que no este en la lista negra
    if ($fila[6] == 0 && $fila[8] == 1) {
      sessionEmprendimiento($fila, $mysqli, $resultado);
    } //de estar en la lista negra se les avisa
    elseif ($fila[6] == 1) {
      header("Location:../sesiones/login.php?error=Ese usuario a sido 
          baneado permanentemente no intente registrarse nuevamente.");

      CloseALL($resultado);
    } //si no es valido le aviso 
    else {
      header("Location:../sesiones/login.php?error=Su cuenta debe ser validada. Dirijase a la oficina de la juventud, ubicada en el parque, junto a su cedula de identidad para que se verifiquen sus datos");
      CloseALL($resultado);
    } //fin de condiciones

  } //si no se encuentra su usuario le aviso
  else {
    //fallo principal, no se encontro los datos en la base de datos
    header("Location:../sesiones/login.php?error=Compruebe usuario y contraseña");
    CloseALL($resultado);
  } //fin de condiciones
} //si no esta seteado le aviso
else {
  header("Location:../sesiones/login.php?error=Los campos son requeridos");
  exit();
} //fin de condiciones

/////////////
//funciones//
/////////////


function sessionEmprendimiento($fila, $mysqli, $result1)
{

  $queryEmprendimiento = "SELECT `Id_emprendimientos`,`Nombre_Emprendimiento`,`Id_categoria`,`Emprendimiento_valido` 
  FROM `emprendimientos` WHERE `Id_Usuario` = $fila[0]";
  try {
    $result2 = $mysqli->query($queryEmprendimiento);
    $filaEmprendimiento = $result2->fetch_row();
  } catch (\Throwable $th) {
    CloseALL($result1);
    CloseALL($result2);
  }
  $datosSesionEmprendimiento = array(
    'identificador' => $filaEmprendimiento[0],
    'nombreEmprendimiento' => $filaEmprendimiento[1],
    'categoria' => $filaEmprendimiento[2],
    'validacionEmprendimiento' => $filaEmprendimiento[3]
  );
  $_SESSION['datosEmprendimiento'] = $datosSesionEmprendimiento;
  setcookie("nombreEmprendimiento", $_SESSION['datosEmprendimiento']["nombreEmprendimiento"], time() + 9000);
  logear($fila, $result1);
  CloseALL($result2);
};
//funcion para logear
function logear($fila, $resultado)
{
  $datosSesion = array('id' => $fila[0], 'nombre' => $fila[1], 'apellido' => $fila[2], 'correo' => $fila[4], 'Lista_N' => $fila[6], 'Id_rango' => $fila[7], 'User_Valido' => $fila[8]);
  $_SESSION['sesionMain'] = $datosSesion;
  setcookie("user", $_SESSION['sesionMain']["nombre"], time() + 9000);
  header("Location:../../index.php");
  CloseALL($resultado);
}
//funcion para cerrar las conexiones y las consultas
function CloseALL($resultado)
{
  $resultado->close();
  exit();
}
//funcion para validar los datos
function validarLogin($datos)
{
  $datos = trim($datos);
  $datos = stripcslashes($datos);
  $datos = htmlspecialchars($datos);
  return $datos;
}
