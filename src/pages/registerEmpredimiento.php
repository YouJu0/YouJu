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
  <title>Emprendimiento</title>
</head>

<body>
  <form action="./apis/regsEmpredimiento.php" method="POST">
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
    
    <!-- nombre empredimiento -->
    <label for="">Nombre emprendimiento :</label>
    <input type="text" name="nombreEmprendimiento" id="NombreEmprendimiento" placeholder="Ingrese el nombre del empredimiento" required>
    
    <!-- categoria -->
    <label for="">categoria :</label>
    <select name="categorias" id="categorias" required>
    <option value="">servicios</option>
    <option value="">manualidades</option>
    <option value="">artes culinarias</option>
    </select>

    <!-- -->
    <label for="">numero de contacto :</label>
    <input type="text" name="numeroDeContacto" id="numeroDeContacto" placeholder="ingrese su numero de contacto" required>
    <!-- -->
    
    <label for="">Describe tu empredimiento :</label>
    <input type="text" name="descripcionDeEmprendimiento" id="descripcionDeEmprendimiento" required>

    <!-- -->
    
    <label for="">puedes poner dos redes sociales (opcional):</label>
    <input type="text" name="redSocial1" id="redSocial1">
    <input type="text" name="redSocial2" id="redSocial2">
    <!-- -->
    
    <label for=""> ubicacion (opcional):</label>
    <input type="text" name="ubicacion" id="ubicacion">



    <br>
    <button type="submit">enviar</button>
    <br>
    <a href="./login.php">ingresar</a>
  
  </form>
</body>

</html>