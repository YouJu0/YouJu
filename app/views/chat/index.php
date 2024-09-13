<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div id="chat-box" class="chat-box bg-gray-100 p-4 h-64 overflow-y-scroll"></div>
  <form id="chat-form">
    <?php set_csrf(); ?>
    <input type="hidden" id="forum-id" name="forum-id" value="1">
    <input type="text" id="message" name="message" placeholder="Escribe un mensaje..." class="border rounded p-2 w-2/3">
    <button type="submit" class="p-2 bg-blue-500 text-white rounded">Enviar</button>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let offset = 0;
      const chatBox = document.getElementById('chat-box');
      const forumId = document.getElementById('forum-id').value;
      const newMessageBtn = document.createElement('button');
      let newMessageCount = 0;

      newMessageBtn.textContent = 'Ver mensajes nuevos';
      newMessageBtn.style.display = 'none';
      document.body.appendChild(newMessageBtn);

      // Cargar mensajes antiguos
      function loadMessages(offset) {
        fetch(`/get_Msg.php?forum_id=${forumId}&offset=${offset}`)
          .then(response => response.json())
          .then(messages => {
            messages.reverse().forEach(msg => {
              chatBox.insertAdjacentHTML('afterbegin', `
                        <div class="message mb-4">
                            <div class="inline-block bg-gray-200 p-4 rounded-md max-w-xs">
                                <span class="font-semibold">${msg.username}:</span>
                                <span>${msg.message}</span>
                            </div>
                        </div>
                    `);
            });
          })
          .catch(error => console.error('Error al cargar los mensajes:', error));
      }

      // Cargar los primeros 35 mensajes
      loadMessages(offset);

      // Scroll hacia arriba para cargar más mensajes
      chatBox.addEventListener('scroll', function() {
        if (chatBox.scrollTop === 0) { // Si llega al tope
          offset += 35;
          loadMessages(offset);
        }
      });

      // WebSocket para mensajes nuevos
      const conn = new WebSocket('ws://localhost:8080');

      conn.onmessage = function(event) {
        const data = JSON.parse(event.data);

        // Si es un nuevo mensaje
        if (data.new_message) {
          newMessageCount++;
          newMessageBtn.textContent = `Ver mensajes nuevos (${newMessageCount})`;
          newMessageBtn.style.display = 'block';

          chatBox.insertAdjacentHTML('beforeend', `
                <div class="message mb-4">
                    <div class="inline-block bg-blue-200 p-4 rounded-md max-w-xs">
                        <span class="font-semibold">${data.username}:</span>
                        <span>${data.message}</span>
                    </div>
                </div>
            `);
        }
      };

      // Bajar hasta el final del chat al hacer clic en el botón de mensajes nuevos
      newMessageBtn.addEventListener('click', function() {
        chatBox.scrollTop = chatBox.scrollHeight;
        newMessageBtn.style.display = 'none';
        newMessageCount = 0;
      });

      // Si el usuario hace scroll al final, ocultar el botón de mensajes nuevos
      chatBox.addEventListener('scroll', function() {
        if (chatBox.scrollTop >= chatBox.scrollHeight - chatBox.offsetHeight) {
          newMessageBtn.style.display = 'none';
          newMessageCount = 0;
        }
      });
    });
  </script>
</body>

</html>