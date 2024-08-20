<?php
session_start();
if (isset($_SESSION['sesionMain'])) {



}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../main.css">
  <title>Emprendimiento</title>
</head>

<body>
  <form action="../apis/regsEmpredimientoApi.php" method="POST">
    <h1> Registrar empredimiento</h1>
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
    
    <!-- nombre -->
    <label for="">Nombre emprendedor :</label>
    <input type="text" name="nombre" placeholder="Ingrese su nombre" required>
    <br>
    
    <!-- nombre empredimiento -->
    <label for="">Nombre emprendimiento :</label>
    <input type="text" name="nombreEmprendimiento" placeholder="Ingrese el nombre del empredimiento" required>
    <br>
    <!-- categoria -->
    <label for="">categoria :</label>
    <select name="categorias"  required>
    <option value="1">servicios</option>
    <option value="2">manualidades</option>
    <option value="3">artes culinarias</option>
    </select>
    <br>
    <!-- -->

    <label for="">numero de contacto :</label>
    <input type="int" name="numeroDeContacto" id="numeroDeContacto" placeholder="ingrese su numero de contacto" required>
    <br>
    <!-- -->
    
    <label for="">Describe tu empredimiento :</label>
    <input type="text" name="descripcionDeEmprendimiento" id="descripcionDeEmprendimiento" required>
    <br>
    <!-- -->
    <label for="">puedes poner dos redes sociales (opcional):</label>
    <input type="text" name="redSocial1">
    <input type="text" name="redSocial2">
    <br>
    <!-- -->
    
    <label for=""> ubicacion (opcional):</label>
    <input type="text" name="ubicacion">



    <br>
    <button type="submit">enviar</button>
    <br>
    <a href="./login.php">ingresar</a>
  
  </form>
</body>

</html>