<?php
session_start();
if (!isset($_SESSION['sesionMain'])) {
  header("Location: /");
  exit(); // Asegurar que el script termine después de la redirección
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <!-- Cabeza de la pagina -->
  <header class="flex flex-row fixed z-[999] h-9 bg-[#e07f49] py-5 items-center justify-between px-2 top-0 w-screen">
    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <!-- Menú desplegable de izquierda a derecha -->
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-menu-trigger" type="button" class="hs-dropdown-toggle flex items-center gap-x-2 text-sm font-semibold">
          <img src="/app/assets/menu.svg" class="h-5" alt="">
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[200px] bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-menu-trigger">
          <?php
          $menuItems = [
            'Inicio' => '#',
            'Servicios' => '#',
            'Contacto' => '#'
          ];
          foreach ($menuItems as $itemName => $itemLink) {
            echo "<a class='flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700' href='$itemLink'>$itemName</a>";
          }
          ?>
        </div>
      </div>

      <?php
      echo isset($_SESSION['sesionMain'])
        ? '<a href="/"> Inicio </a>'
        : '<button id="openPopup">Foro</button>';
      ?>

      <a href="#"><img src="/app/assets/logo.png" class="flex h-8" alt=""></a>
    </div>

    <div class="flex items-center h-full flex-row gap-4 justify-center">
      <div class="hs-dropdown relative inline-flex">
        <button id="hs-dropdown-custom-trigger" type="button" class="hs-dropdown-toggle py-1 ps-1 pe-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full">
          <img class="w-8 h-auto rounded-full" src="/app/assets/header/users.webp">
          <span class="text-[#1B3A61] font-medium truncate max-w-[7.5rem]">
            <?php echo isset($_SESSION['sesionMain']) ? $_SESSION['sesionMain']['nombre'] : $offline["name"]; ?>
          </span>
        </button>
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" aria-labelledby="hs-dropdown-custom-trigger">
          <?php if (!isset($_SESSION['sesionMain'])): ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/sesiones/login.php">Log-In</a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/sesiones/register.php">Sign-In</a>
          <?php else: ?>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">Configuración</a>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">Mi Perfil</a>

            <?php if ($_SESSION['sesionMain']["Id_rango"] == 3): ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/admin/panelAdmin.php">panel admin</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['datosEmprendimiento'])): ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./emprendimiento.php">
                emprendimiento : <?php echo $_SESSION['datosEmprendimiento']["nombreEmprendimiento"]; ?>
              </a>
            <?php else: ?>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/sesiones/registerEmprendimiento.php">Registrar emprendimiento</a>
            <?php endif; ?>

            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="./pages/apis/sessionClose.php">Cerrar sesión</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>


  <!-- Fin de la sección de encabezado -->
  <main class="bg-[url('/app/assets/chat/bg.webp')] flex flex-row w-full h-screen items-center align-middle bg-cover bg-center pt-10 relative">
    <!-- Selección de Foro con botones estilo pestaña a la izquierda -->
    <div class="flex flex-col relative w-1/4 justify-end items-end right-0 gap-4 ">
      <button id="forum-btn-1" class="forum-btn flex flex-col relative bg-teal-400 border-4 border-green-800 rounded-l-lg px-6 py-2 text-blue-400 overflow-hidden" data-forum="1">
        <span class="relative z-10 text-white font-bold drop-shadow-lg">General</span>
        <span class="flex absolute left-0 w-full h-full bg-teal-700/90 transform translate-y-1/2"></span>
      </button>

      <button id="forum-btn-2" class="forum-btn flex flex-col relative bg-teal-400 border-4 border-green-800 rounded-l-lg px-6 py-2 text-blue-400 overflow-hidden" data-forum="2">
        <span class="relative z-10 text-white font-bold drop-shadow-lg">Salud mental</span>
        <span class="flex absolute left-0 w-full h-full bg-teal-700/90 transform translate-y-1/2"></span>
      </button>
    </div>
    <div class="flex flex-row items-center h-full">
      <!-- Contenedor de las pestañas -->

      <div class="flex flex-col absolute rounded-3xl border-[12px] p-6 border-[#3d5b4f] bg-white w-3/5 right-20 h-3/4">

        <!-- Chat box -->
        <div class="chat-box flex overflow-y-scroll w-full h-[90%] flex-col-reverse pr-4" id="chat-box">

        </div>
        <form id="chat-form" class="flex relative h-16 border-[8px] border-[#3d5b4f] rounded-2xl p-2 items-center justify-between">
          <input type="hidden" id="forum-id" name="forum-id" value="1">
          <input type="text" class="flex w-4/5 rounded-md outline-none p-2 h-full" id="message" name="message" placeholder="Escribe un mensaje..." required>
          <button class="btn-send" type="submit">
            <img src="/app/assets/components/btn-send/btn-send.webp" class="btn w-14" alt="">
          </button>
        </form>

      </div>

    </div>
  </main>

  <!-- Script para cambiar de foro -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const forumBtns = document.querySelectorAll('.forum-btn');
      const forumIdInput = document.getElementById('forum-id');
      const chatBox = document.getElementById('chat-box');
      const isAdmin = <?php echo $_SESSION['sesionMain']["Id_rango"] == 3 ? 'true' : 'false'; ?>;
      const currentUser = "<?php echo $_SESSION['sesionMain']['nombre']; ?>"; // Nombre del usuario actual

      console.log("Is Admin:", isAdmin); // Verifica si isAdmin es correcto

      // Cambiar de foro usando botones
      forumBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          // Eliminar la clase activa de todos los botones
          forumBtns.forEach(b => b.classList.remove('bg-blue-600', 'text-white'));
          // Agregar la clase activa al botón seleccionado
          this.classList.add('bg-blue-600', 'text-white');
          forumIdInput.value = this.getAttribute('data-forum');
          loadMessages(); // Recargar mensajes para el foro seleccionado
        });
      });

      // Función para cargar los mensajes del foro seleccionado
      function loadMessages(offset = 0) {
        fetch(`./get_Msg.php?forum_id=${forumIdInput.value}&offset=${offset}`)
          .then(response => response.json())
          .then(data => {
            chatBox.innerHTML = ''; // Limpiar el contenido del chat box
            data.forEach(msg => {
              let deleteButton = isAdmin ? `<button class="ml-2 text-red-500" onclick="eliminarMSG(${msg.msgId})">Eliminar</button>` : '';
              let alignment = ''; // Variable para la alineación de los mensajes
              let bgColor = 'bg-gray-200'; // Color de fondo por defecto

              // Verificar si el mensaje fue enviado por el usuario actual
              if (msg.username === currentUser) {
                alignment = 'text-right'; // Alineación derecha si el usuario envió el mensaje
                bgColor = 'bg-blue-200'; // Cambiar el color de fondo para los mensajes del usuario actual
              } else {
                alignment = 'text-left'; // Alineación izquierda para otros usuarios
              }

              // Renderizar los mensajes en la caja de chat
              chatBox.innerHTML += `
                                <div class="message mb-4 ${alignment}">
                                    <div class="inline-block ${bgColor} p-4 rounded-md max-w-xs">
                                        <span class="font-semibold">${msg.username}:</span>
                                        <span>${msg.message}</span>
                                        <br>
                                        <small class="text-gray-500">${msg.created_at}</small>
                                        ${deleteButton}
                                    </div>
                                </div>`;
            });
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll automático al final
          })
          .catch(error => console.error('Error al cargar los mensajes:', error));
      }

      document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const messageInput = document.getElementById('message');

        fetch('./send_Msg.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
              message: messageInput.value,
              forum_id: forumIdInput.value
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error('Error al enviar el mensaje:', data.error);
            } else {
              messageInput.value = '';
              loadMessages(); // Recargar los mensajes
            }
          })
          .catch(error => console.error('Error al enviar el mensaje:', error));
      });

      function startRefresh() {
        setInterval(() => loadMessages(), 5000); // Actualiza cada 5 segundos
      }

      startRefresh();
      loadMessages();
    });
  </script>
</body>

</html>