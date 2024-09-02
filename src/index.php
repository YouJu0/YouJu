<?php
include_once('./tools/sessionConfig.php');
$offline = array(
  "estado" => "deslogeado",
  "name" => "guest"
);

if (!isset($_SESSION['sesionMain'])) {
  // Si no está seteada te manda para login (descomentar si se requiere redirección)
  // header("Location: ./pages/sesiones/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./main.css">
  <link rel="stylesheet" href="../node_modules/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="../node_modules/preline/dist/preline.css">

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
      height: 50%;
      overflow: hidden;
      position: relative;
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
    }

    .swiper-button-next {
      right: 20px;
    }

    #services {
      margin-top: 50px;
    }

    .popup {
      display: none;
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
      z-index: 1000;
      pointer-events: none;
    }

    .popup-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      width: 300px;
      text-align: center;
      pointer-events: auto;
      position: relative;
    }

    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
      font-size: 24px;
    }
  </style>
</head>

<body class="flex flex-col max-w-screen ">

  <!-- Cabeza de la pagina -->

  <img id="img-header" class="flex absolute w-screen mt-9" style="z-index: 100;" src="./assets/headerWave.png" alt="">

  <header class="flex flex-row fixed z-[999] h-9 bg-[#A7DE72] py-5 items-center justify-between px-2 top-0 w-screen">
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <!-- Menú desplegable de izquierda a derecha -->
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-menu-trigger" type="button" class="hs-dropdown-toggle flex items-center gap-x-2 text-sm font-semibold">
          <img src="assets/menu.svg" class="h-5" alt="">
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[200px] bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-menu-trigger">
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm
                  text-gray-800 hover:bg-gray-100 focus:outline-none
                  focus:bg-gray-100 dark:text-neutral-400
                  dark:hover:bg-neutral-700 dark:hover:text-neutral-300
                  dark:focus:bg-neutral-700"
            href="#">Inicio</a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm
                  text-gray-800 hover:bg-gray-100 focus:outline-none
                  focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700
                  dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
            href="#">Servicios</a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm
                  text-gray-800 hover:bg-gray-100 focus:outline-none 
                  focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700
                  dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
            href="#">Contacto</a>
        </div>
      </div>
      <?php
      if (isset($_SESSION['sesionMain'])) {
        echo '<a href="./pages/chat/chat.php"> Foro </a>';
      } else {
        echo '<button id="openPopup">Foro</button>';
      }
      ?>

      <a href="#"><img src="assets/logo.png" class="flex h-8" alt=""></a>
    </div>

    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-dropdown-custom-trigger" type="button" class="hs-dropdown-toggle py-1 ps-1 pe-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full">
          <img class="w-8 h-auto rounded-full" src="assets/users.png">
          <span class="text-[#1B3A61] font-medium truncate max-w-[7.5rem]">
            <?php
            if (isset($_SESSION['sesionMain'])) {
              echo $_SESSION['sesionMain']['nombre'];
            } else {
              echo $offline["name"];
            }
            ?>
          </span>
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-dropdown-custom-trigger">
          <?php
          if (!isset($_SESSION['sesionMain'])) {
          ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/sesiones/login.php">
              Log-In
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/sesiones/register.php">
              Sign-In
            </a>
          <?php
          } else {
          ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
              Configuración
            </a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
              Mi Perfil
            </a>
            <?php
            if (isset($_SESSION['datosEmprendimiento'])) {
            ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./emprendimiento.php">
                emprendimiento : <?php echo $_SESSION['datosEmprendimiento']["nombreEmprendimiento"]; ?>
              </a>
            <?php
            } else {
            ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/sesiones/registerEmprendimiento.php">
                Registrar emprendimieto
              </a>
            <?php
            }
            ?>

            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/apis/sessionClose.php">
              Cerrar sesión
            </a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>

  </header>

  <!-- Fin de la sección de encabezado -->



  <!-- Inicio de la sección de bienvenida -->

  <style>
    #welcome {
      background-image: url("./assets/backgrounds/first.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  </style>

  <main class="container max-w-[100vw] h-auto items-center justify-center ">
    <section id="welcome" class="flex flex-col xl:flex-row justify-between items-center h-[calc(100vh-3.5rem)] overflow-hidden">
      <div class="flex flex-col justify-center items-center w-full xl:w-auto">
        <div class="flex items-center p-14 text-[#A7DE72] overflow-hidden mx-auto ">
          <img src="./assets/lines-title.png" class="h-32" alt="">
          <div class="flex flex-col justify-center mx-4">
            <h1 class="text-2xl sm:text-xl md:text-3xl lg:text-7xl font-semibold leading-tight text-center mx-auto">¡Bienvenida Juventud!</h1>
            <img src="./assets/underline.png" class="w-4/5 m-auto mt-2 sm:w-3/5 md:w-2/5 sm:mt-4" alt="">
          </div>
          <img src="./assets/lines-title.png" class="h-32 scale-x-[-1]" alt="">
        </div>

        <a href="#services" id="start-button" class="btn flex items-center justify-center relative">
          <p class="absolute inset text-4xl font-semibold text-white size-full flex items-center justify-center hover:mt-4 transition-all">
            Continuar
          </p>
          <img src="./assets/components/btn/btn-green.png" class="btn h-20 sm:h-36" alt="">
        </a>

        <style>
          div.bubble {

            /* &::after {
              content: "";
              position: absolute;
              inset: 0;
              background-color: #F3BA4D;
              z-index: 0;
              margin-bottom: -10px;
              border-radius: 0.5rem
            } */

          }
        </style>

        <div class="size-[300px] bg-red-200 flex flex-col gap-5">

          <div class="bubble relative w-max max-w-full mb-[8px]">
            <div class="background absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#F3BA4D]"></div>

            <div class="background sticky z-10 border-4 border-[#F3BA4D] w-max max-w-full bg-yellow-300 text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
              asdasdasda
            </div>
          </div>
          <div class="bubble relative w-max max-w-full mb-[8px]">
            <div class="background absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#F3BA4D]"></div>

            <div class="background sticky z-10 border-4 border-[#F3BA4D] w-max max-w-full bg-yellow-300 text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
              asdasdasda
            </div>
          </div>
          <div class="bubble relative w-max max-w-full mb-[8px]">
            <div class="background absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#F3BA4D]"></div>

            <div class="background sticky z-10 border-4 border-[#F3BA4D] w-max max-w-full bg-yellow-300 text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
              asdasdasda
            </div>
          </div>
          <div class="bubble relative w-max max-w-full mb-[8px]">
            <div class="background absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#F3BA4D]"></div>

            <div class="background sticky z-10 border-4 border-[#F3BA4D] w-max max-w-full bg-yellow-300 text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
              asdasdasda
            </div>
          </div>

        </div>
      </div>

      <img src="./assets/logo.png" class="h-32 sm:h-80 -rotate-[16deg] mt-10 md:block md:h-60" alt="">
    </section>

    <!-- Fin de la sección de bienvenida -->



    <!-- Inicio de Sección de Servicios  -->

    <section id="services" class="flex justify-center items-center h-[calc(100vh+0.56rem)] w-full relative bg-[url('./assets/backgrounds/second.png')] bg-cover bg-no-repeat bg-center">
      <!-- <img src="" alt="bg" class="absolute left-0 w-full z-[1] top-0"> -->
      <div class="swiper-container relative w-[200px]">
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

    <!-- Fin de Sección de Servicios  -->
  </main>

  <!-- Zona para popup -->
  <div id="popup" class="popup">
    <div class="popup-content">
      <span id="closePopup" class="close">&times;</span>
      <h2>Usuario Offline</h2>
      <p>Para acceder a todo el contenido de la página debes de estar logeado.</p>
      <a href="./pages/sesiones/login.php">[Log-In]</a>
      <br>
      <a href="./pages/sesiones/register.php">[Sign-In]</a>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../node_modules/swiper/swiper-bundle.min.js"></script>
  <script src="../node_modules/preline/dist/preline.js"></script>
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

  <!-- Script para los popups -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const openPopupButton = document.getElementById('openPopup');
      const closePopupButton = document.getElementById('closePopup');
      const popup = document.getElementById('popup');

      openPopupButton.addEventListener('click', () => {
        popup.style.display = 'flex'; // Mostrar el popup
        popup.style.pointerEvents = 'auto'; // Habilitar interacción con el popup
      });

      closePopupButton.addEventListener('click', () => {
        popup.style.display = 'none'; // Ocultar el popup
        popup.style.pointerEvents = 'none'; // Deshabilitar interacción con el popup
      });

      // Ocultar el popup si se hace clic fuera de él
      window.addEventListener('click', (event) => {
        if (event.target === popup) {
          popup.style.display = 'none';
          popup.style.pointerEvents = 'none'; // Deshabilitar interacción con el popup
        }
      });

      const buttons = document.querySelectorAll("a.btn");
      buttons.forEach((button) => {
        const buttonImg = button.querySelector("img")

        button.addEventListener("mouseenter", () => {
          buttonImg.src = "./assets/components/btn/btn-green-hover.png"
        });

        button.addEventListener("mouseleave", () => {
          buttonImg.src = "./assets/components/btn/btn-green.png";
        });
      });
    });
  </script>
</body>

</html>