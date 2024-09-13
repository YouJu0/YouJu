<?php

include(__DIR__ . '/../connection/module.connection.php');

// Verifica si los campos no están vacíos
if (
  isset($_POST["nombre"])
  && isset($_POST["apellido"])
  && isset($_POST["email"])
  && isset($_POST["pass"])
  && isset($_POST["confirmPass"])
  && isset($_POST["fecha_nacimiento"])
) {
  // Cargo los datos en variables y los valido
  $name = validarRegistro($_POST["nombre"]);
  $apellido = validarRegistro($_POST["apellido"]);
  $email = validarRegistro($_POST["email"]);
  $pass = validarRegistro($_POST['pass']);
  $confpass = validarRegistro($_POST['confirmPass']);
  $fecha = validarRegistro($_POST['fecha_nacimiento']);

  // Verificar rango de edad
  if (rangoEdad($fecha)) {
    // Verificar si las contraseñas coinciden
    if ($pass === $confpass) {
      // Encriptar la contraseña de forma segura
      $passcrypt = password_hash($pass, PASSWORD_BCRYPT);

      // Intentar insertar los datos en la base de datos usando declaraciones preparadas
      $query = "INSERT INTO `usuarios` (`Nombre`, `Apellido`, `Contraseña`, `Email`, `Fecha_Nac`, `Lista_N`, `Id_rango`, `User_Valido`) 
                      VALUES (?, ?, ?, ?, ?, 0, 1, 0)";
      $stmt = $mysqli->prepare($query);

      if ($stmt) {
        $stmt->bind_param("sssss", $name, $apellido, $passcrypt, $email, $fecha);

        try {
          $resultado = $stmt->execute(); // Ejecutar la consulta

          if ($resultado) {
            // Redirigir al inicio de sesión después de registrar al usuario
            include(__DIR__ . "/module.login.php");
            $stmt->close();
            exit();
          } else {
            header("Location: /register?error=EL correo ya está registrado o no cumple los requisitos");
            exit();
          }
        } catch (Exception $e) {
          header("Location: /register?error=El correo ya está registrado o algo ha ido mal");
          exit();
        }
      }
    } else {
      // Si las contraseñas no coinciden, redirigir con un mensaje de error
      header("Location: /register?error=Las contraseñas no coinciden");
      exit();
    }
  } else {
    // Si el rango de edad no es válido
    header("Location: /register?error=Debe tener entre 14 y 29 años para registrarse");
    exit();
  }
} else {
  header("Location: /register?error=Todos los campos son requeridos");
  exit();
}

// Función para verificar el rango de edad
function rangoEdad($fecha)
{
  $min = 14;
  $max = 29;
  $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
  $calculo = $nacio->diff(new DateTime());
  $edad = $calculo->y;
  return ($edad >= $min && $edad <= $max);
}

// Función para validar los datos del registro
function validarRegistro($datos)
{
  $datos = trim($datos);
  $datos = stripslashes($datos);
  $datos = htmlspecialchars($datos);
  return $datos;
}
