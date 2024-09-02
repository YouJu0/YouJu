<?php
include_once('./tools/sessionConfig.php');
if (!isset($_SESSION['sesionMain'])) {
  //si no está seteada te manda para login
  //header("Location: ./pages/sesiones/login.php");
  $offline = array(
    "estado" => "deslogeado",
    "name" => "guest"
  );
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
      height: 40vh;
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


    /* Estilo del popup no borrar pls a menos que lo cambien por algo mejor jeje */
    .popup {
      display: none;
      /* Ocultar el popup por defecto */
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      /* Fondo semitransparente */
      justify-content: center;
      align-items: center;
      z-index: 1000;
      /* Asegurarse de que esté sobre otros elementos */
      pointer-events: none;
      /* Deshabilitar interacción con elementos subyacentes */
    }

    .popup-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      width: 300px;
      text-align: center;
      pointer-events: auto;
      /* Habilitar interacción con el contenido del popup */
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

<body>
  <img id="img-header" class="flex absolute w-screen mt-9" style="z-index: 100;" src="./assets/headerWave.png" alt="">

  <header class="flex flex-row fixed z-[999] h-9 bg-[#A7DE72] py-5 items-center justify-between px-2 top-0 w-full">
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <!-- Menú desplegable de izquierda a derecha -->
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-menu-trigger" type="button" class="hs-dropdown-toggle flex items-center gap-x-2 text-sm font-semibold">
          <img src="assets/menu.svg" class="h-5" alt="">
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[200px] bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-menu-trigger">
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
            Inicio
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
            Servicios
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
            Contacto
          </a>
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
            if ($_SESSION['sesionMain']["Id_rango"] == 3) {
            ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/admin/panelAdmin.php">
                panel admin
              </a>
            <?php
            }
            ?>


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
        <a href="#services" id="start-button" class="flex items-center justify-center">
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
  <!--zona para popup -->
  <div id="popup" class="popup">
    <div class="popup-content">
      <span id="closePopup" class="close">&times;</span>
      <h2>Usuario Offline</h2>
      <p>para acceder a todo el contenido de la pagina debes de estar logeado</p>
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

  <!--script para los popups by el papu osea dilan -->
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

      // Opcional: Ocultar el popup si se hace clic fuera de él
      window.addEventListener('click', (event) => {
        if (event.target === popup) {
          popup.style.display = 'none';
          popup.style.pointerEvents = 'none'; // Deshabilitar interacción con el popup
        }
      });
    });
  </script>
</body>

</html>