<?php
session_start();
if (!isset($_SESSION['sesionMain'])) {
  header("Location: /");
  exit(); // Asegurar que el script termine después de la redirección
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/src/assets/css/style.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>Chat</title>
</head>

<body>
  <!-- Cabeza de la página -->
  <?php
  $headerColor = "#e07f49";
  $mainMenu = ['/', 'Inicio'];
  include 'src/components/header.php';
  ?>

  <!-- Fin de la sección de encabezado -->
  <main class="bg-[url('/src/assets/chat/bg.webp')] flex flex-row w-full h-screen items-center align-middle bg-cover bg-center pt-10 relative">
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
        <div class="chat-box flex overflow-y-scroll w-full h-[90%] flex-col-reverse pr-4" id="chat-box"></div>

        <form id="chat-form" class="flex relative h-16 border-[8px] border-[#3d5b4f] rounded-2xl p-2 items-center justify-between">
          <input type="hidden" id="user-name" name="user-name" value="<?php echo htmlspecialchars($_SESSION['sesionMain']['nombre']); ?>">
          <input type="hidden" id="forum-id" name="forum-id" value="1">
          <input type="text" class="flex w-4/5 rounded-md outline-none p-2 h-full" id="message" name="message" placeholder="Escribe un mensaje..." required>
          <button type="submit" class="btn-send" id="submit-btn">
            <img src="/src/assets/components/btn-send/btn-send.webp" class="btn w-14" alt="">
          </button>
        </form>
      </div>
    </div>
  </main>

  <!-- Script para gestionar el WebSocket y el chat -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const forumBtns = document.querySelectorAll('.forum-btn');
      const forumIdInput = document.getElementById('forum-id');
      const chatBox = document.getElementById('chat-box');
      const isAdmin = <?php echo ($_SESSION['sesionMain']["Id_rango"] == 3) ? 'true' : 'false'; ?>;
      const currentUser = "<?php echo htmlspecialchars($_SESSION['sesionMain']['nombre']); ?>"; // Nombre del usuario actual
      const conn = new WebSocket('ws://localhost:8080');
      console.log("Is Admin:", isAdmin); // Verifica si isAdmin es correcto

      // Manejadores de eventos del WebSocket
      conn.onopen = function(e) {
        console.log("¡Conexión establecida!");
      };
      conn.onerror = function(error) {
        console.error("Error en la conexión WebSocket: ", error);
      };
      conn.onclose = function(e) {
        console.log("Conexión cerrada: ", e);
      };
      conn.onmessage = function(e) {
        const respuesta = JSON.parse(e.data);
        const nombre = currentUser;
        const rango = <?php echo (int)$_SESSION['sesionMain']['Id_rango']; ?>;

        let alignment = '';
        let bgColor = 'bg-gray-200';

        let deleteButton = '';
        if (rango > 1) {
          deleteButton = `<button class="ml-2 text-red-500" onclick="">Eliminar</button>`;
        }

        if (respuesta.usuario_name === nombre) {
          alignment = 'text-right';
          bgColor = 'bg-blue-200';
        } else {
          alignment = 'text-left';
        }

        // Renderizar los mensajes en la caja de chat
        chatBox.innerHTML += `<div class="message mb-4 ${alignment}">
                                <div class="inline-block ${bgColor} p-4 rounded-md max-w-xs">
                                  <span class="font-semibold">${respuesta.usuario_name}:</span>
                                  <span>${respuesta.mensaje}</span>
                                  <br>
                                  <small class="text-gray-500">${respuesta.created_at}</small>
                                  ${deleteButton}
                                </div>
                              </div>`;
        chatBox.scrollTop = chatBox.scrollHeight; // Scroll automático al final
      };

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
      function loadMessages() {
    const forumId = document.getElementById('forum-id').value; // Obtener el ID del foro
    fetch(`/chat/messages/get?forum_id=${forumId}`)
        .then(response => response.json())
        .then(data => {
            chatBox.innerHTML = ''; // Limpiar el contenido del chat box
            data.forEach(msg => {
                let alignment = (msg.username === currentUser) ? 'text-right' : 'text-left';
                let bgColor = (msg.username === currentUser) ? 'bg-blue-200' : 'bg-gray-200';

                chatBox.innerHTML += `<div class="message mb-4 ${alignment}">
                                        <div class="inline-block ${bgColor} p-4 rounded-md max-w-xs">
                                            <span class="font-semibold">${msg.username}:</span>
                                            <span>${msg.message}</span>
                                            <br>
                                            <small class="text-gray-500">${msg.created_at}</small>
                                        </div>
                                      </div>`;
            });
            chatBox.scrollTop = chatBox.scrollHeight; // Desplazar hacia abajo para mostrar el nuevo mensaje
        })
        .catch(error => console.error('Error al cargar los mensajes:', error));
}

// Llamar a la función al cargar la página
loadMessages();
    });
  </script>
  <script type="module">
    import preline from 'https://cdn.jsdelivr.net/npm/preline@2.5.0/+esm'
  </script>
</body>

</html>
