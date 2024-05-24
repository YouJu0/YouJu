<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../main.css">
  <title>cuenta</title>
</head>

<body>
  <form action="./apis/login_API.php" method="POST">
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
    <label for="">Email :</label>
    <input type="email" name="Email" placeholder="ingrese su email">
    <label for="">Contraseña :</label>
    <input type="text" name="Pass" placeholder="ingrese su password" required>
    <button type="submit">Iniciar sesion</button>
    <a href="./register.php">Registrarse</a>
  </form>
</body>

</html>