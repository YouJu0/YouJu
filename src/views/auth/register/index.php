<?php
session_start();

if (isset($_SESSION['sesionMain'])) {
  header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/main.css">
  <title>cuenta</title>
</head>

<body>
  <form action="/procesar/register" method="POST">
    <h1> Iniciar sesion</h1>
    <hr>
    <?php
    if (isset($_GET['error'])) {
    ?>
      <p class="error">
        <?php
        echo $_GET['error']
        ?>
      </p>
    <?php
    }
    ?>
    <hr>
    <!-- -->
    <label for="">Nombre :</label>
    <input type="text" name="nombre" placeholder="Ingrese su nombre" required
      pattern="[A-Za-zñÑ]+">
    <br>
    <!-- -->
    <label for="">apellido :</label>
    <input type="text" name="apellido" placeholder="Ingrese su apellido" required
      pattern="[A-Za-zñÑ]+">
    <br>
    <!-- -->
    <label for="">Email :</label>
    <input type="email" name="email" placeholder="Ingrese su correo electronico" required
      pattern=".+@.*\..*">
    <br>
    <!-- -->
    <label for="">Contraseña :</label>
    <input type="password" name="pass" placeholder="Ingrese su contraseña" required
      pattern="[A-Za-z0-9-_@]+">
    <br>
    <!-- -->
    <label for="">Confirmar Contraseña :</label>
    <input type="password" name="confirmPass" placeholder="Vuelva a ingresar su contraseña" required
      pattern="[A-Za-z0-9-_@]+">
    <br>
    <!-- -->
    <label for="">ingrese su fecha de nacimiento :</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
    <br>
    <!-- -->
    <button type="submit">[ -Completar Registro- ]</button>
    <br>

    <!-- -->
    <a href="/login">[ -ingresar- ]</a>

  </form>
</body>

</html>