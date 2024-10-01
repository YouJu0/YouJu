<?php
session_start();
include("../conn.php"); // Asegúrate de que la ruta sea correcta

// Compruebo si los campos están seteados
if (isset($_POST["email"]) && isset($_POST["pass"])) {
    // Cargo los datos validados en variables
    $email = validarLogin($_POST["email"]);
    $pass = $_POST['pass'];

    // Creo la query
    $Qlogin = "SELECT * FROM `usuarios` WHERE `Email` = '$email'";
    $resultado = $mysqli->query($Qlogin);

    // Verifico si se encontró el usuario
    if ($resultado && $resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc(); // Obtengo los datos del usuario

        // Verifico la contraseña
        if (password_verify($pass, $fila['Contraseña'])) {
            // Contraseña correcta, inicio sesión
            $_SESSION['sesionMain'] = $fila; 
            header("Location: /"); 
            exit();
        } else {
            // Contraseña incorrecta

            $_SESSION['status'] = "Credenciales incorrectas.";
            header("Location:/login");
            exit();
        }
    } else {
        // Usuario no encontrado
        $_SESSION['status'] = "Credenciales incorrectas.";

        header("Location:/login");
        exit();
    }
} else {
    // Campos no seteados
    $_SESSION['status'] = "Todos los campos son necesarios";
    header("Location:/login");
    exit();
}

// Función para validar login
function validarLogin($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}
?>