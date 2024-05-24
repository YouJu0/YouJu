<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./main.css">
  <link rel="stylesheet" href="./style.css">
  <title>cuenta</title>
</head>

<body>
  <form action="./apis/register.php" method="POST">
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
    <input type="text" name="Name" placeholder="ingrese su name" required>
    <label for="">Email :</label>
    <input type="email" name="Email" placeholder="ingrese su email" required>
    <label for="">Contraseña :</label>
    <input type="text" name="Pass" placeholder="ingrese su password" required>
    <label for="">Confirmar Contraseña :</label>
    <input type="text" name="CONFIPass" placeholder="vuelva a ingresar su password" required>
    <button type="submit">Registrarse</button>
    <a href="./login.php">ingresar</a>
  </form>
</body>

</html>