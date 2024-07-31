<?php
function guardarMSG(){
include("../../conexion.php");
//compruebo si tiene sesion
if (isset($_SESSION['sesionMain'])) {
    //guardo tanto el nombre como el correo
    $correo_user = $_SESSION['sesionMain']["correo"];
}else{
    header("Location: ../../../index.php?error=Para poder hablar por el foro debe de estar logeado");
}
    $query = "INSERT INTO `chat` (`email`,`msg`) 
    VALUES ('$correo_user','$var_MSG');";
            //intento la querry, si falla lo atrapo
        try {
            //carga el resultado en una variable  
            $resultado = $mysqli->query($query);
   
            header("Location: http://localhost:3000/");
        }catch (\Throwable $th) {
            header("Location: ../register.php?error=Algo pase al guardar los msg");}}
?>

<script>
     //guardo los msg en una variable 
     $var_MSG = document.writeln(m); // igualar el valor de la variable JavaScript a PHP 
     setInterval(guardarMSG(), 120000)

fetch('https://api.example.com/data')
    .then(response => response.json())  // Convierte la respuesta en JSON
    .then(data => {
        console.log(data);  // Manejar los datos
    })
    .catch(error => {
        console.error('Error:', error);  // Manejar errores
    });
</script>




           