<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprendimientos</title>
    <link rel="stylesheet" href="/src/css/main.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row" id="emprendimientos-container">
        </div>
    </div>

    <script>

        
    async function cargarEmprendimientos() {
    try {
        const response = await fetch('/controller/get-business');
        const result = await response.json();

        if (!result.success) {
            throw new Error(result.message || 'Error desconocido');
        }

        const emprendimientos = result.data;
        const container = document.getElementById('emprendimientos-container');

        emprendimientos.forEach(emprendimiento => {
            const card = document.createElement('div');
            card.classList.add('col-md-4', 'mb-4');

            card.innerHTML = `
                <div class="flex h-100">
                    <div class="card-body">
                        <h5 class="card-title">${emprendimiento.Nombre_Emprendimiento}</h5>
                        <p class="card-text">${emprendimiento.Descripcion}</p>
                        <p><strong>Ubicación:</strong> ${emprendimiento.Ubicacion}</p>
                        <a href="/business/${emprendimiento.id}" target="_blank" class="btn btn-secondary">Red Social 2</a>
                        
                        
                    </div>
                </div>
            `;

            container.appendChild(card);
        });
    } catch (error) {
        console.error('Error al cargar los emprendimientos:', error);
    }
}
        // Llamar a la función para cargar los emprendimientos cuando la página cargue
        window.onload = cargarEmprendimientos;
    </script>
</body>
</html>