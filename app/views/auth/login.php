<?php
session_start();
if (isset($_SESSION['sesionMain'])) {
  session_set_cookie_params(30); // La duración de la cookie es de 30 segundos.
  header("Location: /");
  exit(); // Añadir exit para detener la ejecución después de la redirección
}
?>
<script>
  // Asignar el nombre de usuario a localStorage correctamente
  <?php if (isset($_SESSION['sesionMain'])): ?>
    localStorage.setItem("user", "<?php echo $_SESSION['sesionMain']['nombre']; ?>");
  <?php endif; ?>
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/app/style/main.css">
  <title>Iniciar sesión</title>
</head>

<body>
  <form action="/controller/login" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="Ingrese su correo electrónico" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
    <br>
    <button type="submit">[ -Iniciar sesión- ]</button>
  </form>
</body>

</html>