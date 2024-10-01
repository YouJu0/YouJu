<?php
session_start();
if (isset($_SESSION['sesionMain'])) {
  header("Location: /");
  session_set_cookie_params(60 * 0.5);
}
?>
<script>
  
localStorage.setItem("user"= $_SESSION["sesionMain"]["nombre"]);

</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/main.css">
  <title>cuenta</title>
</head>

<body>
  <form action="/procesar/login" method="POST">
    <h1> Iniciar sesion</h1>
    <hr>
    <?php
    if (isset($_SESSION['status'])) {
    ?>
      <p class="error">
        <?php
        echo $_SESSION['status'];
        unset($_SESSION['status']);
        ?>
      </p>
    <?php
    }
    ?>
    <hr>
    <label for="">Email: </label>
    <input type="email" name="email" placeholder="Ingrese su correo electronico"
    key>
    <label for="">Contraseña: </label>
    <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
    <br>
    <button type="submit">[ -Iniciar sesion- ]</button>
    <a href="/register">[ -Registrarse- ]</a>
  </form>
</body>
</html>