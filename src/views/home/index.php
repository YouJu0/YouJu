<?php
session_start();
if (!isset($_SESSION['sesionMain'])) {
  //si no está seteada te manda para login
  //header("Location: ./pages/sesiones/login.php");
  $offline = array(
    "estado" => "No logeado",
    "name" => "Invitado"
  );
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="/src/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="/node_modules/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="/node_modules/preline/dist/preline.css">
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

<body class="flex flex-col max-w-screen ">

  <!-- Cabeza de la pagina -->

  <img id="img-header" class="flex absolute w-screen mt-9" style="z-index: 100;" src="/src/assets/header/headerWave.webp" alt="">

    <?php
    $headerColor = "#A7DE72";
    $mainMenu = ['/chat', 'Chat'];
    include 'src/components/header.php';
    ?>
    


<!-- Fin de la sección de encabezado -->



<!-- Inicio de la sección de bienvenida -->


  <main class="container max-w-[100vw] h-auto items-center justify-center ">
    <section id="welcome" class="flex flex-col xl:flex-row justify-between items-center h-screen bg-[url('/src/assets/section-one/bg.webp')] bg-cover bg-no-repeat bg-center overflow-hidden px-24">
      <div class=" flex flex-col justify-center items-center w-5/6 xl:w-auto">
        <div class="flex items-center p-14 text-[#A7DE72] overflow-hidden ">
          <img src="/src/assets/section-one/lines-title.webp" class="w-24" alt="">
          <div class="flex flex-col justify-center mx-4">
            <h1 class="text-2xl sm:text-xl md:text-3xl lg:text-7xl font-semibold leading-tight text-center mx-auto">
              ¡Bienvenida Juventud!
            </h1>
            <img src="/src/assets/section-one/underline.webp" class="w-24 m-auto mt-2 sm:w-3/5 md:w-2/5 sm:mt-4" alt="">
          </div>
          <img src="/src/assets/section-one/lines-title2.webp" class="h-32" alt="">
        </div>

        <a href="#services" id="start-button" class="btn flex items-center justify-center relative">
          <p class="absolute inset text-4xl font-semibold text-white size-full flex items-center justify-center hover:mt-4 transition-all">
            Continuar
          </p>
          <img src="/src/assets/components/btn/btn-green.webp" class="btn w-72" alt="">
        </a>
      </div>


      <img src="/src/assets/general/logo.webp" class="h-32 sm:h-80 -rotate-[16deg] mt-10 md:block md:h-60" alt="">
    </section>

    <!-- Fin de la sección de bienvenida -->



    <!-- Inicio de Sección de Servicios  -->

    <section id="services" class="flex justify-center items-center h-screen w-full relative bg-[url('/src/assets/section-two/bg.webp')] bg-cover bg-no-repeat bg-center">
      <div class="swiper-container relative w-[200px]">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="/src/assets/emprendimientos/a.webp" alt="Imagen 1" />
          </div>
          <div class="swiper-slide">
            <img src="/src/assets/emprendimientos/b.webp" alt="Imagen 2" />
          </div>
          <div class="swiper-slide">
            <img src="/src/assets/emprendimientos/c.webp" alt="Imagen 3" />
          </div>
          <div class="swiper-slide">
            <img src="/src/assets/emprendimientos/a.webp" alt="Imagen 1" />
          </div>
          <div class="swiper-slide">
            <img src="/src/assets/emprendimientos/b.webp" alt="Imagen 2" />
          </div>
          <div class="swiper-slide">
            <img src="/src/assets/emprendimientos/c.webp" alt="Imagen 3" />
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

    <!-- Inicio del Chat y Temas  -->

    <section id="chat-and-threads" class="flex justify-center  items-center h-[calc(100vh+0.56rem)] w-full relative bg-[url('/src/assets/section-three/bg.webp')] bg-cover bg-no-repeat bg-center">

      <!-- Temas -->
      <div id="threads" class="w-[650px]  flex flex-col mx-auto p-8">
        <div class="flex justify-between items-stretch h-max ">
          <img src="/src/assets/section-three/shape.webp" class="flex w-10" alt="">
          <h3 class="flex bg-[#fff768] relative w-full justify-center items-center h-auto text-3xl font-bold border-t-4 border-[#fbba45]">Tema</h3>
          <img src="/src/assets/section-three/shape.webp" class="flex w-10 scale-x-[-1]" alt="">
        </div>

        <div class="flex relative outline-offset-0 outline-8 -top-1  flex-col gap-5 mx-auto p-4 border-x-4 border-b-4 rounded-b-xl bg-[#fff768] border-[#fbba45] w-[calc(100%-4.5rem)]">

          <div class="w-full rounded-md outline-offset-0 outline-8 flex flex-col gap-5 mx-auto -mt-4 bg-white p-4">
            <div class="bubble relative self-end w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                Drogas
              </div>
            </div>
            <div class="bubble relative self-start w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                Sexualidad
              </div>
            </div>
            <div class="bubble relative self-end w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                Violencia
              </div>
            </div>
            <div class="bubble relative self-start w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                LGBTQ
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Temas -->



      <div id="chat" class="w-[650px]  flex flex-col mx-auto p-8">
        <div class="flex justify-between items-stretch h-max ">
          <img src="/src/assets/section-three/shape.webp" class="flex w-10" alt="">
          <h3 class="flex bg-[#fff768] relative w-full justify-center items-center h-auto text-3xl font-bold border-t-4 border-[#fbba45]">Chat</h3>
          <img src="/src/assets/section-three/shape.webp" class="flex w-10 scale-x-[-1]" alt="">
        </div>

        <div class="flex relative outline-offset-0 outline-8 -top-1  flex-col gap-5 mx-auto p-4 border-x-4 border-b-4 rounded-b-xl bg-[#fff768] border-[#fbba45] w-[calc(100%-4.5rem)]">

          <div class="w-full rounded-md outline-offset-0 outline-8 flex flex-col gap-5 mx-auto -mt-4 bg-white p-4">
            <div class="bubble relative self-end w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                Drogas
              </div>
            </div>
            <div class="bubble relative self-start w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                Sexualidad
              </div>
            </div>
            <div class="bubble relative self-end w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                Violencia
              </div>
            </div>
            <div class="bubble relative self-start w-max max-w-full mb-[8px]">
              <div class="absolute z-0 left-[50%] translate-x-[-50%] w-full h-full top-[8px] rounded-2xl bg-[#fbba45]"></div>

              <div class="sticky z-10 border-4 border-[#fbba45] w-max max-w-full bg-[#fff768] text-green-900 font-bold text-lg px-4 py-2 rounded-2xl truncate">
                LGBTQ
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- Fin del Chat y Temas  -->


  </main>
  <!--zona para popup -->
  <div id="popup" class="popup">
    <div class="popup-content">
      <span id="closePopup" class="close">&times;</span>
      <h2>El usuario no tiene una sesión activa</h2>
      <p>Para acceder a todo el contenido de la pagina debes de estar logeado</p>
      <a href="/login">Iniciar sesión</a>
      <br>
      <a href="/register">Registrarse</a>
    </div>
  </div>

  <!-- Scripts -->
  <script src="/node_modules/swiper/swiper-bundle.min.js"></script>
  <script src="/node_modules/preline/dist/preline.js"></script>
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

      const buttons = document.querySelectorAll("a.btn");
      buttons.forEach((button) => {
        const buttonImg = button.querySelector("img")

        button.addEventListener("mouseenter", () => {
          buttonImg.src = "/src/assets/components/btn/btn-green-hover.webp"
        });

        button.addEventListener("mouseleave", () => {
          buttonImg.src = "/src/assets/components/btn/btn-green.webp";
        });
      });
    });
  </script>
</body>

</html>