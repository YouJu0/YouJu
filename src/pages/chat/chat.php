<?php
session_start();
if (!isset($_SESSION['sesionMain'])) {
    //si no está seteada te manda para login
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100vw;
            align-items: center;
            justify-content: center;
        }

        .chat-box {
            width: 400px;
            height: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: scroll;
        }

        .message {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h1>Chat en PHP</h1>

    <!-- Selección de Foro -->
    <label for="forum-select">Selecciona un Foro:</label>
    <select id="forum-select">
        <option value="1" selected="true">ggeneral</option>
        <option value="2">salud mental</option>
    </select>

    <div class="chat-box" id="chat-box">
        <!-- Los mensajes se cargarán aquí -->
    </div>

    <form id="chat-form">
        <input type="hidden" id="forum-id" name="forum-id" value="">
        <label for="message">Mensaje:</label>
        <input type="text" id="message" name="message" required>
        <button type="submit">Enviar</button>
    </form>

    <a href="../../index.php">Volver a la página principal</a>



    <script>
        document.addEventListener('DOMContentLoaded', function() {



            const forumSelect = document.getElementById('forum-select');
            const forumIdInput = document.getElementById('forum-id');
            const chatBox = document.getElementById('chat-box');

            // Cambiar de foro
            forumSelect.addEventListener('change', function() {
                forumIdInput.value = this.value;
                loadMessages();
            });

            if (forumIdInput.value == 0) {
                forumIdInput.value = 1;
            }
            // Función para cargar los mensajes del foro seleccionado
            function loadMessages() {
                const forumId = forumIdInput.value;

                fetch('./get_Msg.php?forum_id=' + forumId)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Datos recibidos:', data); // Verifica los datos recibidos
                        chatBox.innerHTML = '';
                        data.forEach(msg => {
                            if (msg.validez == 1) {
                                chatBox.innerHTML += `
                    <div class="message">
                        <span class="username">${msg.username}:</span>
                        <span>${msg.message}</span>
                        <br>
                        <small>${msg.created_at}</small>
                        ` +
                                    <?php
                                    if ($_SESSION['sesionMain']["Id_rango"] == 3) {
                                    ?> `
                                        <button onclick="eliminarMSG(${msg.msgId})">eliminar mensaje</button>
                                     ` +
                                    <?php
                                    }
                                    ?> `
                    </div>`;
                            } else {
                                chatBox.innerHTML += `
                    <div class="message">
                        <span class="username">${msg.username}:</span>
                        <span>tu mensaje fue borrado por un moderador</span>
                    </div>`;
                            }
                        });
                        chatBox.scrollTop = chatBox.scrollHeight;
                    })
                    .catch(error => console.error('Error al cargar los mensajes:', error));
            }
            loadMessages();
            // Enviar nuevo mensaje


            function eliminarMSG(idMsg) {
                fetch('./eliminarMSG.php?idmsg=' + idMsg, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('mensaje eliminado exitosamente');
                            loadMessages(); // Recargar el caht después de eliminar un msg
                        } else {
                            alert('Error al eliminar el mensaje');
                        }
                    });
            }


            document.getElementById('chat-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const messageInput = document.getElementById('message');

                function sendMessages() {
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
                                loadMessages();
                            }
                        })
                        .catch(error => console.error('Error al enviar el mensaje:', error));
                }

                sendMessages();
            });
            // Configurar actualizaciones periódicas
            setInterval(loadMessages, 5000); // Actualiza cada 5 segundos
        });
    </script>
</body>

</html>