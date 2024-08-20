<?php

//compruebo la session y de no estar lo mando al login con un aviso
session_start();
if (!isset($_SESSION['sesionMain'])) {
    header('Location: ../sesiones/login.php?error=para ingresar a los foros debe estar logeado');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
<!-- genero unos estilos simples para que sea cuadrado el chat-->
    <style>
        body{ display: flex;flex-direction: column;height: 100vh;width: 100vw;align-items: center;
            justify-content: center;}
        .chat-box { width: 400px; height: 300px; border: 1px solid #ccc; padding: 10px; overflow-y: scroll; }
        .message { margin-bottom: 15px; }
    </style>
</head>
<body>
<!-- comienzo a darle forma al chat -->
    <h1>Chat en PHP</h1>
    <div class="chat-box" id="chat-box">
        <!-- Los mensajes se cargan aquí -->
    </div>
<!-- creo el foro con los inputs -->
    <form id="chat-form">
        <label for="message">Mensaje:</label>
        <input type="text" id="message" name="message" required>
        <button type="submit">Enviar</button>
    </form>

    <!-- un enlace para volver al index -->
    <a href="../../index.php">volver a la pagina principal</a>
    <!-- genro un script que sube y trae los datos de la base de datos  -->
    <script>
        //creo un fetch a al php que trae los mensajes
        document.addEventListener('DOMContentLoaded', function() {
            //funcion par apoder traer los mensajes mas facil
            function loadMessages() {
                fetch('./get_Msg.php')
                    .then(response => response.json())
                    .then(data => {
                        //inserto los mensajes con un formato de un div el nombre y el mensaje (esto se puede modificar a gusto)
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
                    })//en el caso de dar error se muestra este mensaje
                    .catch(error => console.error('Error al cargar los mensajes:', error));
            }
            //en este caso hago un fetch pero ahora para enviar los mensajes a la base de datos
            document.getElementById('chat-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const messageInput = document.getElementById('message');
                const message = messageInput.value;

                fetch('./send_Msg.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ message: message })
                })
                .then(response => response.json())
                .then(data => {//de no dar error cargo los mensajes
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
        