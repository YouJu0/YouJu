<?php
session_start();
if (isset($_SESSION['sesionMain'])) {
  header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../main.css">
  <title>cuenta</title>
</head>

<body>
  <form action="./apis/registerApi.php" method="POST">
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
    <label for="">Nombre :</label>
    <input type="text" name="name" placeholder="Ingrese su nombre" required>
    <label for="">Email :</label>
    <input type="email" name="email" placeholder="Ingrese su correo electronico" pattern=".+@.*\..*" required>
    <label for="">Contraseña :</label>
    <input type="text" name="pass" placeholder="Ingrese su contraseña" required>
    <label for="">Confirmar Contraseña :</label>
    <input type="text" name="confirmPass" placeholder="Vuelva a ingresar su contraseña" required>
    <label for="">ingrese su fecha de nacimiento :</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">

    <br>
    <button type="submit">enviar</button>
    <br>
    <a href="./login.php">ingresar</a>
  
  </form>
</body>

</html>