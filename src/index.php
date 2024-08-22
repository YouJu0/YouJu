<?php
include_once('./tools/sessionConfig.php');
if (!isset($_SESSION['sesionMain'])) {
  //si no esta seteada te manda para login
  header("Location: ./pages/sesiones/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./main.css">
  <link rel="stylesheet" href="../node_modules/swiper/swiper-bundle.min.css">

  <title>YouJu | Inicio</title>
  <style>
    html {
      scroll-behavior: smooth;
    }

    .swiper-container {
      display: flex;
      justify-content: center;
      width: 80%;
      margin-inline: auto;
      height: 40vh;
      overflow: hidden;
      position: relative;
      /* Necesario para que las flechas se posicionen correctamente */
    }

    .swiper-slide {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      transition: all 0.5s ease;
    }

    .swiper-slide:is(.swiper-slide-active) {
      transform: scale(0.85);
    }

    .swiper-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: #fff;
      position: absolute;
      top: 50%;
      width: 27px;
      height: 44px;
      margin-top: -22px;
      z-index: 10;
      cursor: pointer;
    }

    .swiper-button-prev {
      left: 20px;
      /* Ajusta la distancia desde el carrusel */
    }

    .swiper-button-next {
      right: 20px;
      /* Ajusta la distancia desde el carrusel */
    }

    #services {
      margin-top: 50px;
    }
  </style>
</head>

<body>
  <img id="img-header" class="flex absolute w-screen mt-9" style="z-index: 100;" src="./assets/headerWave.png" alt="">

  <header class="flex flex-row fixed z-[999] h-9 bg-[#A7DE72] py-5 items-center justify-between px-2 top-0 w-full">
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <button class="flex items-center h-full"><img src="assets/menu.svg" class="h-5" alt=""></button>
      <a href="/"><img src="assets/logo.png" class="flex h-8" alt=""></a>
      <a href="./pages/chat/chat.php">dawdawd</a>
    </div>
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-dropdown-custom-trigger" type="button" class="hs-dropdown-toggle py-1 ps-1 pe-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full<?php echo isset($_SESSION['sesionMain']) ? '' : ' hidden'; ?>">
          <img class="w-8 h-auto rounded-full" src="assets/users.png">
          <span class="text-[#1B3A61] font-medium truncate max-w-[7.5rem]">
            <?php echo isset($_SESSION['sesionMain']) ? $_SESSION['sesionMain']['nombre'] : ''; ?>
          </span>
        </button>
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
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/apis/sessionClose.php">
              Cerrar sesión
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <script>
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
        <a href="#services" id="start-button" class="flex items-center justify-center<?php echo isset($_SESSION['sesionMain']) ? ' hidden' : ''; ?>">
          <img src="./assets/first-button.png" class="h-36" alt="">
        </a>
      </div>
      <img src="./assets/logo.png" class="h-80 -rotate-[16deg]" alt="">
    </section>

    <section id="services" class="flex justify-center items-center h-[calc(100vh+0.56rem)] w-[100vw]">
      <img src="./assets/backgrounds/second.png" alt="bg" class="absolute top-[calc(100vh-3.5rem)] left-0 w-full h-full z-[1]">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="./assets/emprendimientos/a.webp" alt="Imagen 1" />
          </div>
          <div class="swiper-slide">
            <img src="./assets/emprendimientos/b.webp" alt="Imagen 2" />
          </div>
          <div class="swiper-slide">
            <img src="./assets/emprendimientos/c.webp" alt="Imagen 3" />
          </div>
          <div class="swiper-slide">
            <img src="./assets/emprendimientos/a.webp" alt="Imagen 1" />
          </div>
          <div class="swiper-slide">
            <img src="./assets/emprendimientos/b.webp" alt="Imagen 2" />
          </div>
          <div class="swiper-slide">
            <img src="./assets/emprendimientos/c.webp" alt="Imagen 3" />
          </div>
        </div>

        <!-- Paginación -->
        <div class="swiper-pagination"></div>

        <!-- Navegación -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

    </section>

  </main>


  <!-- Scripts -->
  <script src="../node_modules/swiper/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".swiper-container", {
      slidesPerView: 1.7,
      spaceBetween: 20,
      centeredSlides: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      loop: true,
      loopedSlides: 3,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

    });
  </script>
</body>

</html>