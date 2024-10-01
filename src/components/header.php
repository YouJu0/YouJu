
<?php

$headerColor = isset($headerColor) ? $headerColor : "#A7DE72";

?>

<header style="background-color: <?php echo $headerColor; ?>;" class="flex flex-row fixed z-[999] h-9 py-5 items-center justify-between px-2 top-0 w-screen">
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <!-- Menú desplegable de izquierda a derecha -->
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-menu-trigger" type="button" class="hs-dropdown-toggle flex items-center gap-x-2 text-sm font-semibold">
          <img src="/src/assets/menu.svg" class="h-5" alt="">
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[200px] bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-menu-trigger">
          <?php
          $menuItems = [
            'Inicio' => '/',
            'Servicios' => '/#servicios',
          ];
          foreach ($menuItems as $itemName => $itemLink) {
            echo "<a class='flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700' href='$itemLink'>$itemName</a>";
          }
          ?>
        </div>
      </div>

      <!-- Enlace al foro o botón para abrir el popup -->
      <?php echo isset($_SESSION['sesionMain']) ? '<a href="'. $mainMenu[0].'">' .  $mainMenu[1]. '</a>' : '<button id="openPopup">Chat</button>'; ?>
      <a href="#"><img src="/src/assets/general/logo.webp" class="flex h-8" alt=""></a>
    </div>

    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-dropdown-custom-trigger" type="button" class="hs-dropdown-toggle py-1 ps-1 pe-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full">
          <img class="w-8 h-auto rounded-full" src="/src/assets/header/users.webp">
          <span class="text-[#1B3A61] font-medium truncate max-w-[7.5rem]">
            <?php echo isset($_SESSION['sesionMain']) ? $_SESSION['sesionMain']['Nombre'] : $offline["name"]; ?>
          </span>
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-dropdown-custom-trigger">
          <?php if (!isset($_SESSION['sesionMain'])): ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/login">Log-In</a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/register">Sign-In</a>
          <?php else: ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">Configuración</a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">Mi Perfil</a>
            <?php if ($_SESSION['sesionMain']["Id_rango"] == 3): ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/panel-admin">panel admin</a>
            <?php endif; ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/logout">Cerrar sesión</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
