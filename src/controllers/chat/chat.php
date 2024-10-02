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
  session_start();
  if (!isset($_SESSION['sesionMain'])) {
    header("Location: /");
    exit();
  }
  $headerColor = "#e07f49";
  $mainMenu = ['/', 'Inicio'];
  include 'src/components/header.php';
  ?>

  <main class="bg-[url('/src/assets/chat/bg.webp')] flex flex-row w-full h-screen items-center align-middle bg-cover bg-center pt-10 relative">
    <div class="flex flex-col relative w-1/4 justify-end items-end right-0 gap-4">
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
      <div class="flex flex-col absolute rounded-3xl border-[12px] p-6 border-[#3d5b4f] bg-white w-3/5 right-20 h-3/4">
        <div class="chat-box flex overflow-y-scroll w-full h-[90%] flex-col-reverse pr-4" id="chat-box"></div>
        <form id="chat-form" class="flex relative h-16 border-[8px] border-[#3d5b4f] rounded-2xl p-2 items-center justify-between">
          <input type="hidden" id="user-name" value="<?php echo $_SESSION['sesionMain']['nombre']; ?>">
          <input type="hidden" id="forum-id" value="1">
          <input type="text" class="flex w-4/5 rounded-md outline-none p-2 h-full" id="message" placeholder="Escribe un mensaje..." required>
          <button type="submit" class="btn-send" id="submit-btn">
            <img src="/src/assets/components/btn-send/btn-send.webp" class="btn w-14" alt="Enviar">
          </button>
        </form>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const conn = new WebSocket('ws://localhost:8080');
      const chatBox = document.getElementById('chat-box');
      const currentUser = "<?php echo $_SESSION['sesionMain']['nombre']; ?>";
      
      conn.onopen = function() {
        console.log("Conexión WebSocket establecida");
      };

      conn.onmessage = function(e) {
        const data = JSON.parse(e.data);

        if (data.type === 'previousMessages') {
          data.data.forEach(msg => {
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
        } else if (data.type === 'newMessage') {
          let alignment = (data.username === currentUser) ? 'text-right' : 'text-left';
          let bgColor = (data.username === currentUser) ? 'bg-blue-200' : 'bg-gray-200';

          chatBox.innerHTML += `<div class="message mb-4 ${alignment}">
                                  <div class="inline-block ${bgColor} p-4 rounded-md max-w-xs">
                                    <span class="font-semibold">${data.username}:</span>
                                    <span>${data.message}</span>
                                    <br>
                                    <small class="text-gray-500">${data.created_at}</small>
                                  </div>
                                </div>`;
          chatBox.scrollTop = chatBox.scrollHeight;
        }
      };

      document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const message = document.getElementById('message').value;
        const payload = {
          usuario_name: currentUser,
          mensaje: message,
          chat: document.getElementById('forum-id').value,
          created_at: new Date().toISOString()
        };
        conn.send(JSON.stringify(payload));
        document.getElementById('message').value = '';
      });
    });
  </script>
</body>
</html>
