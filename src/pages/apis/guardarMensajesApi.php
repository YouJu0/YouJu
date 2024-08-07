<?php
include("../../conexion.php");
//compruebo si tiene sesion
if (isset($_SESSION['sesionMain'])) {
    //guardo tanto el nombre como el correo
    $_user = $_SESSION['sesionMain']["nombre"];
}else{
    header("Location: ../../../index.php?error=Para poder hablar por el foro debe de estar logeado");
}
// Leer los datos JSON del cuerpo de la solicitud
$data = file_get_contents('php://input');

// Decodificar el JSON en un array asociativo
$dataArray = json_decode($data, true);

$msg = $dataArray['msg'];
    




    $query = "INSERT INTO `chat` (`name`,`msg`) 
    VALUES ('$_user','$msg');";
            //intento la querry, si falla lo atrapo
        try {
            //carga el resultado en una variable  
            $resultado = $mysqli->query($query);
   
            header("Location: http://localhost:3000/");
        }catch (\Throwable $th) {
            header("Location: ../register.php?error=Algo pase al guardar los msg");}
?>

<script>
     // igualar el valor de la variable JavaScript a PHP  
     $var_MSG = document.writeln(m); 
     //seteo un timer
     setInterval(guardarMSG(), 120000);
</script>




           