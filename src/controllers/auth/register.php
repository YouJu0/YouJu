<?php
error_reporting(E_ALL); // Reportar todos los errores
ini_set('display_errors', 1); // Mostrar errores en la pantalla
session_start();
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("Formulario de registro enviado."); // Registro de inicio
    // Verifica si los campos no están vacíos
    if (
        isset($_POST["nombre"]) &&
        isset($_POST["apellido"]) &&
        isset($_POST["email"]) &&
        isset($_POST["pass"]) &&
        isset($_POST["confirmPass"]) &&
        isset($_POST["fecha_nacimiento"])
    ) {
        error_log("Todos los campos están presentes."); // Registro de campos
        // Cargo los datos en variables
        $name = validarRegistro($_POST["nombre"]);
        $apellido = validarRegistro($_POST["apellido"]);
        $email = validarRegistro($_POST["email"]);
        $pass = validarRegistro($_POST['pass']);
        $confpass = validarRegistro($_POST['confirmPass']);
        $fecha = validarRegistro($_POST['fecha_nacimiento']);

        // Comprueba rango de edad
        if (rangoEdad($fecha)) {
            // Verifica si las contraseñas coinciden
            if ($pass === $confpass) {
                // Encripto la contraseña
                $passcrypt = password_hash($pass, PASSWORD_DEFAULT);
                // Guardo la query en una variable
                $query = "INSERT INTO `usuarios` (`Id_Usuario`, `Nombre`, `Apellido`, `Contraseña`, `Email`, `Fecha_Nac`, `Lista_N`, `Id_rango`, `User_Valido`) 
                          VALUES (null, '$name', '$apellido', '$passcrypt', '$email', '$fecha', 0, 1, 0)";
                // Intento la query, si falla lo atrapo
                try {
                    $resultado = $mysqli->query($query);
                    if ($resultado) {
                        $_SESSION['status'] = "Registro exitoso, por favor inicie sesión.";

                        header("Location: /login");
                        exit();
                    } else {
                        $_SESSION['status'] = "Error al registrar, intente nuevamente.";
                        header("Location: /register");
                        exit();
                    }
                } catch (\Throwable $th) {
                    $_SESSION['status'] = "El correo ya está registrado o algo ha ido mal.";

                    header("Location: /register");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Las contraseñas no coinciden.";

                header("Location: /register");
                exit();
            }
        } else {
            $_SESSION['status'] = "Debe tener entre 14 y 29 años para registrarse.";

            header("Location: /register");
            exit();
        }
    } else {
        $_SESSION['status'] = "Todos los campos son requeridos.";
        header("Location: /register");
        exit();
    }
} 
// Funciones para validar
function rangoEdad($fecha) {
    $min = 14;
    $max = 29;
    $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
    $calculo = $nacio->diff(new DateTime());
    $edad = $calculo->y;
    return $edad >= $min && $edad <= $max;
}

function validarRegistro($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}
?>