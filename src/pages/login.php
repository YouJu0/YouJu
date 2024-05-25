<?php
session_start();
if (isset($_SESSION['sesionMain'])) {
  header("Location:../index.php");
  session_set_cookie_params(60 * 0.5);
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
  <form action="./apis/loginApi.php" method="POST">
    <h1> Iniciar sesión</h1>
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
    <label for="">Email: </label>
    <input type="email" name="email" placeholder="Ingrese su correo electrónico">
    <label for="">Contraseña: </label>
    <input type="password" name="password" placeholder="Ingrese su contraseña" required>
    <button type="submit">Iniciar sesión</button>
    <a href="./register.php">Registrarse</a>
  </form>
</body>

</html>