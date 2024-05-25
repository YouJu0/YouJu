<?php
include_once('./tools/sessionConfig.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./main.css">
  <title>YouJu | Inicio</title>
</head>

<body>
  <header class="flex flex-row w-full h-12 bg-gray-100 justify-between items-center gap-4 px-10">
    <h2>YouJu</h2>
    <div class=""><a href="./pages/login.php">Iniciar sesion</a></div>
  </header>
  <div>
    <h1>Titulo</h1>
    <a href="./pages/apis/sessionClose_API.php"> Cerrar sesión </a>
    <p>Bienvenido</p>
  </div>
</body>

</html>