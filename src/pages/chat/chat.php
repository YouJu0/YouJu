<?php
session_start();
if (!isset($_SESSION['sesionMain'])) {
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
            display: flex;
            flex-direction: column-reverse;
            /* Reverso el orden de los mensajes */
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
        <option value="1" selected="true">General</option>
        <option value="2">Salud Mental</option>
    </select>

    <div class="chat-box" id="chat-box">
        <!-- Los mensajes se cargarán aquí -->
    </div>

    <form id="chat-form">
        <input type="hidden" id="forum-id" name="forum-id" value="1">
        <label for="message">Mensaje:</label>
        <input type="text" id="message" name="message" required>
        <button type="submit">Enviar</button>
    </form>

    <a href="../../index.php">Volver a la página principal</a>

    <script>
        function eliminarMSG(idMsg) {
            fetch(`./eliminarMSG.php?idmsg=${idMsg}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Mensaje eliminado exitosamente');

                    } else {

                        alert('Error al eliminar el mensaje: ' + result.error);
                    }
                })
                .catch(error => console.error('Error al eliminar el mensaje:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const forumSelect = document.getElementById('forum-select');
            const forumIdInput = document.getElementById('forum-id');
            const chatBox = document.getElementById('chat-box');
            const isAdmin = <?php echo $_SESSION['sesionMain']["Id_rango"] == 3 ? 'true' : 'false'; ?>;

            let refreshInterval;

            // Cambiar de foro
            forumSelect.addEventListener('change', function() {
                forumIdInput.value = this.value;
                loadMessages();
            });
            // Función para cargar los mensajes del foro seleccionado
            function loadMessages(offset = 0) {

                fetch(`./get_Msg.php?forum_id=${forumIdInput.value}&offset=${offset}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.error) {
                            console.error(data.error);
                            return;
                        }

                        chatBox.innerHTML = '';
                        data.forEach(msg => {
                            let deleteButton = '';
                            if (isAdmin) {
                                deleteButton = `<button onclick="eliminarMSG(${msg.msgId})">Eliminar mensaje</button>`;
                            }
                            if (msg.validez == 0) {
                                chatBox.innerHTML += `
                                <div class="message">
                                    <span class="username">${msg.username}:</span>
                                    <span>Tu mensaje fue eliminado por un administrador</span>
                                    <br>
                                    <small>${msg.created_at}</small>
                                </div>`;
                            } else {
                                chatBox.innerHTML += `
                                <div class="message">
                                    <span class="username">${msg.username}:</span>
                                    <span>${msg.message}</span>
                                    <br>
                                    <small>${msg.created_at}</small>
                                    ${deleteButton}
                                </div>`;
                            }
                        });
                        chatBox.scrollTop = chatBox.scrollHeight;
                    })
                    .catch(error => console.error('Error al cargar los mensajes:', error));
            }

            function loadMoreMessages() {
                if (lastMessageId) {
                    fetch(`./get_Msg.php?forum_id=${forumIdInput.value}&last_message_id=${lastMessageId}&load_more=true`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                console.error(data.error);
                                return;
                            }

                            if (data.length > 0) {
                                data.forEach(msg => {
                                    let deleteButton = '';
                                    if (isAdmin) {
                                        deleteButton = `<button onclick="eliminarMSG(${msg.msgId})">Eliminar mensaje</button>`;
                                    }
                                    if (msg.validez == 0) {
                                        chatBox.innerHTML += `
                                        <div class="message">
                                            <span class="username">${msg.username}:</span>
                                            <span>Tu mensaje fue eliminado por un administrador</span>
                                            <br>
                                            <small>${msg.created_at}</small>
                                        </div>`;
                                    } else {
                                        chatBox.innerHTML += `
                                        <div class="message">
                                            <span class="username">${msg.username}:</span>
                                            <span>${msg.message}</span>
                                            <br>
                                            <small>${msg.created_at}</small>
                                            ${deleteButton}
                                        </div>`;
                                    }
                                    lastMessageId = msg.msgId; // Actualiza el último ID de mensaje
                                });

                                chatBox.scrollTop = chatBox.scrollHeight;
                                loadMoreButton.style.display = data.length < 25 ? 'none' : 'block'; // Oculta el botón si no hay más mensajes
                            }
                        })
                        .catch(error => console.error('Error al cargar más mensajes:', error));
                }
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
                refreshInterval = setInterval(() => loadMessages(), 5000); // Actualiza cada 5 segundos
            }

            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    clearInterval(refreshInterval);
                } else {
                    startRefresh();
                }
            });

            startRefresh();
            loadMessages();
        });
    </script>
</body>

</html>