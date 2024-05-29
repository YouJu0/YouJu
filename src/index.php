<?php
include_once('./tools/sessionConfig.php');
if (!isset($_SESSION['sesionMain'])) {
  //si no esta seteada te manda para login
  header("Location: ./pages/login.php");
}

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
    <a id="dropdownInformationButton" data-dropdown-toggle="userDropdown" class="focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
      <img src="./assets/login.svg" class="w-10" alt="">
    </a>

    <?php

    ?>
    <!-- Dropdown menu -->
    <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
      <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">

        <?php
        if (isset($_SESSION['sesionMain'])) {

          print_r('<div>' . $_SESSION['sesionMain']["nombre"] . '</div>');
          print_r('<div class="font-medium truncate">' . $_SESSION['sesionMain']["correo"] . '</div>');
        } ?>
      </div>
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
        <li>
          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
        </li>
        <li>
          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
        </li>
        <li>
          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
        </li>
      </ul>
      <div class="py-2">
        <a href="./pages/apis/sessionClose.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Cerrar sesion</a>
      </div>
    </div>

  </header>
  <div>
    <h1>Titulo</h1>

    <p>Bienvenido</p>
  </div>
  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>