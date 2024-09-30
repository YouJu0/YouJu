<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup en el Centro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        /* Estilo del popup */
.popup {
    display: none; /* Ocultar el popup por defecto */
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 300px;
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 24px;
}

    </style>
    <!-- Botón para abrir el popup -->
    <button id="openPopup">Abrir Popup</button>

    <!-- Estructura del popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span id="closePopup" class="close">&times;</span>
            <h2>Este es un Popup</h2>
            <p>Contenido del popup...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const openPopupButton = document.getElementById('openPopup');
    const closePopupButton = document.getElementById('closePopup');
    const popup = document.getElementById('popup');

    openPopupButton.addEventListener('click', () => {
        popup.style.display = 'flex'; // Mostrar el popup
    });

    closePopupButton.addEventListener('click', () => {
        popup.style.display = 'none'; // Ocultar el popup
    });

    // Opcional: Ocultar el popup si se hace clic fuera de él
    window.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
});

    </script>
</body>
</html>
