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


<style>
  html {
    scroll-behavior: smooth;

  }
</style>


<body>
  <img class="flex w-screen top-9 bg-red-500" style="z-index: 10 ;" src="./src/assets/headerWave.png" alt="">

  <header class="flex flex-row fixed z-[999] h-9 bg-[#A7DE72] py-5 items-center justify-between px-2 top-0 w-full">
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <button class="flex items-center h-full"><img src="assets/menu.svg" class="h-5" alt=""></button>
      <a href="/"><img src="assets/logo.png" class="flex h-8" alt=""></a>
    </div>
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <div class="relative">
        <div id="search-container" class="relative flex flex-row">
          <input id="search-input" type="text" placeholder="Search..." class="relative left-0 rounded-md bg-gray-400 border-gray-200 border-2 text-gray-800 p-1 w-28 focus:bg-white focus:pr-12 transition-all duration-500 transform scale-0 origin-left<?php echo $sessionExist ? ' hidden' : ''; ?>">
          <img id="search-icon" src="assets/search.png" alt="Search" class="w-8 h-8 z-50 cursor-pointer transition-all duration-500 ease-in-out">
        </div>
      </div>
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-dropdown-custom-trigger" type="button" class="hs-dropdown-toggle py-1 ps-1 pe-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full<?php echo !$sessionExist ? ' hidden' : ''; ?>">
          <img class="w-8 h-auto rounded-full" src="assets/users.png">
          <span class="text-[#1B3A61] font-medium truncate max-w-[7.5rem]">
            <?php if ($sessionExist) echo $_SESSION['sesionMain']['nombre']; ?>
          </span>
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2" aria-labelledby="hs-dropdown-custom-trigger">
          <?php
          if ($sessionExist) {
            echo '<a class="flex items-center text-sm py-2 px-3 rounded-md text-gray-600 hover:bg-gray-100 transition duration-150 ease-in-out" href="./pages/apis/sessionClose.php"> 
              <img class="w-8 h-auto rounded-full" src="assets/logout.png">
              <span class="truncate ml-2">Cerrar sesión</span>
            </a>';
          } else {
            echo '<a class="flex items-center text-sm py-2 px-3 rounded-md text-gray-600 hover:bg-gray-100 transition duration-150 ease-in-out" href="./pages/profile.php">
            <img class="w-8 h-auto rounded-full" src="assets/users.png">
            <span class="truncate ml-2">Mi perfil</span>
          </a>';

            echo '<a class="flex items-center text-sm py-2 px-3 rounded-md text-gray-600 hover:bg-gray-100 transition duration-150 ease-in-out" href="./pages/login.php">
              <img class="w-8 h-auto rounded-full" src="assets/login.png">
              <span class="truncate ml-2">Iniciar sesión</span>
            </a>';
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <script>
    document.getElementById('search-icon').addEventListener('click', function() {
      const input = document.getElementById('search-input');
      const img = document.getElementById('search-icon');
      input.classList.toggle('scale-0');
      input.classList.toggle('scale-100');
      img.classList.toggle('move-left');
      input.focus();
    });

    // Scroll lento
    document.getElementById('start-button').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('services').scrollIntoView({
        behavior: 'smooth'
      });
    });
  </script>
  <main class="container">
    <section id="welcome" class="flex flex-row justify-between items-center h-[calc(100vh-3.5rem)]">
      <img src="./assets/backgrounds/first.jpg" alt="bg" class="absolute top-2 w-screen h-full z-[-1]">
      <div class="flex flex-col justify-center items-center">
        <div class="flex items-center p-14 text-[#A7DE72]">
          <img src="./assets/lines-title.png" class="h-32" alt="">

          <div class="flex flex-col w-min justify-center">
            <h1 class="text-[6.5rem] font-semibold leading-[6rem] text-center">¡Bienvenida Juventud!</h1>
            <img src="./assets/underline.png" class="w-4/5 m-auto" alt="">
          </div>
          <img src="./assets/lines-title.png" class="h-32 scale-x-[-1]" alt="">
        </div>

        <a href="#services" id="start-button" class="flex items-center justify-center<?php echo $sessionExist ? ' hidden' : ''; ?>">
          <img src="./assets/first-button.png" class="h-36" alt="">
          <h4 class="text-[2.5rem] absolute text-white">Comenzar</h4>
        </a>
      </div>

      <img src="./assets/logo.png" class="h-80 -rotate-[16deg]" alt="">
    </section>

    <section id="services" class="flex flex-col justify-center items-center h-[calc(100vh+0.56rem)]">
      <img src="./assets/backgrounds/second.jpg" alt="bg" class="absolute top-2 w-screen h-full z-[-1]">
      <div class="flex flex-col justify-center items-center">
        <div class="flex items-center p-14 text-[#A7DE72]">
        </div>
      </div>
    </section>
  </main>
</body>
<script src="../node_modules/preline/dist/preline.js"></script>

</html>