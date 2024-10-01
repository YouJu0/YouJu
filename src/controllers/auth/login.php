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
            $_SESSION['sesionMain'] = $fila; // Guarda los datos del usuario en la sesión
            header("Location: /"); // Redirige a la página principal
            exit();
        } else {
            // Contraseña incorrecta
            header("Location:/login?error=Credenciales incorrectas.");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location:/login?error=Credenciales incorrectas.");
        exit();
    }
} else {
    // Campos no seteados
    header("Location:/login?error=Los campos son requeridos.");
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