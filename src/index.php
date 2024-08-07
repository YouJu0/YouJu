<?php
include_once('./tools/sessionConfig.php');
if (!isset($_SESSION['sesionMain'])) {
  //si no esta seteada te manda para login
  header("Location: ./pages/login.php");
}else{
setcookie("user",$_SESSION['sesionMain']["nombre"], time() +9000);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./main.css">
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <title>YouJu | Inicio</title>

</head>

<body>
  <header class="flex flex-row w-full h-12 bg-gray-100 justify-between items-center gap-4 px-10">

    <a href="http://localhost:3000/"> foro</a>
    <div class="column-one">
      <h2>YouJu</h2>

    </div>


    <div class="column-two">
      <div id="autocomplete"></div>
      <div class="hs-dropdown relative inline-flex">
        <a id="hs-dropdown-default" type="button" class="hs-dropdown-toggle">
          <img src="./assets/login.svg" class="h-11" alt="">
        </a>

        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
            Tu cuenta
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
            Notificaciones
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800  hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/apis/sessionClose.php">
            Cerrar sesión
          </a>
        </div>
      </div>
    </div>


  </header>
  <?php
if (isset($_SESSION['sesionMain'])) {
      print_r('<div>' . $_SESSION['sesionMain']["nombre"] . '</div>');
      print_r('<div class="font-medium truncate">' . $_SESSION['sesionMain']["correo"] . '</div>');
 } 
?>
  <div>
    <h1>Titulo</h1>

    <p>Bienvenido</p>
  </div>
  <script src="../node_modules/preline/dist/preline.js"></script>

</body>

</html>