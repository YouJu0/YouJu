<?php
session_start();
if (!isset($_SESSION['sesionMain'])) {
    header('Location: ../sesiones/login.php?error=para ingresar a los foros debe estar logeado');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat en PHP</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .chat-box { width: 400px; height: 300px; border: 1px solid #ccc; padding: 10px; overflow-y: scroll; }
        .message { margin-bottom: 10px; }
        .username { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Chat en PHP</h1>
    <div class="chat-box" id="chat-box">
        <!-- Los mensajes se cargarán aquí -->
    </div>
    <form id="chat-form">
        <label for="message">Mensaje:</label>
        <input type="text" id="message" name="message" required>
        <button type="submit">Enviar</button>
    </form>

    <a href="../../index.php">volver a la pagina principal</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadMessages() {
                fetch('./get_messages.php')
                    .then(response => response.json())
                    .then(data => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.innerHTML = '';
                        data.forEach(msg => {
                            chatBox.innerHTML += `
                                <div class="message">
                                    <span class="username">${msg.username}:</span>
                                    <span>${msg.message}</span>
                                    <br>
                                    <small>${msg.created_at}</small>
                                </div>
                            `;
                        });
                        chatBox.scrollTop = chatBox.scrollHeight; // Desplazar hacia abajo
                    })
                    .catch(error => console.error('Error al cargar los mensajes:', error));
            }

            document.getElementById('chat-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const messageInput = document.getElementById('message');
                const message = messageInput.value;

                fetch('./send_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error al enviar el mensaje:', data.error);
                    } else {
                        messageInput.value = ''; // Limpiar el campo de mensaje
                        loadMessages(); // Recargar los mensajes
                    }
                })
                .catch(error => console.error('Error al enviar el mensaje:', error));
            });

            // Cargar mensajes al cargar la página
            loadMessages();

            // Actualizar los mensajes cada 5 segundos
            setInterval(loadMessages, 5000);
        });
    </script>
</body>
</html>
        