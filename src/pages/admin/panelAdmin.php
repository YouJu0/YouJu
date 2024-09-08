<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        header {
            background-color: antiquewhite;
            height: 5vh;
            width: 100vw;
            text-align: center;
        }

        .user-list {
            margin: 20px;
        }

        .user-item {
            margin-bottom: 10px;
        }

        .user-item button {
            margin-left: 10px;
        }

        .emprnedimiento-list {
            margin: 20px;
        }

        .emprnedimiento-item {
            margin-bottom: 10px;
        }

        .emprnedimiento-item button {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h3>PanelAdmin</h3>

        <a href="../../index.php">pagina principal</a>
    </header>

    <div class="user-list" id="userList">
        <!-- aca se muestran los usuarios sin validar -->
    </div>
    <div class="emprnedimiento-list" id="emprnedimientoList">
        <!-- aca se muestran los usuarios sin validar -->
    </div>

    <script>
        //llamo las funciones
        CargarUsuarioSinValidar();
        CargarEmprendimientoSinValidar()




        //   //   //   //   //   //   //   
        //functiones de notificaciones//
        //   //   //   //   //   //   //  

        function name(params) {

        }


        //   //   //   //   //   //   //   //
        //functiones de gestion de usuaris //
        //   //   //   //   //   //   //   //
        // Función para mostrar los usuarios sin validar
        function CargarUsuarioSinValidar() {
            fetch('./validarusuarios/usuarioSinValidar.php')
                .then(response => response.json())
                .then(users => {
                    const userList = document.getElementById('userList');
                    userList.innerHTML = ''; // Limpiar la lista

                    users.forEach(user => {
                        // Crear un elemento para cada usuario
                        const userItem = document.createElement('div');
                        userItem.classList.add('user-item');

                        // Crear el texto del usuario
                        const userText = document.createElement('span');
                        userText.textContent = `${user.Nombre} ${user.Apellido} (${user.Email})`;

                        // Crear el botón de validación
                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Validar';
                        validateButton.onclick = () => ValidarUsuario(user.Id_Usuario);

                        userItem.appendChild(userText);
                        userItem.appendChild(validateButton);
                        userList.appendChild(userItem);
                    });
                });
        }
        // Función para validar un usuario
        function ValidarUsuario(userId) {
            fetch('./validarusuarios/validacion.php?id=' + userId, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Usuario validado exitosamente');
                        CargarUsuarioSinValidar(); // Recargar la lista después de validar
                    } else {
                        alert('Error al validar el usuario');
                    }
                });
        }
        //duncion para mostrar los usuarios sin validar
        function CargarEmprendimientoSinValidar() {
            fetch('./validaremprendimiento/emprendimientoSinValidar.php')
                .then(response => response.json())
                .then(emprendimiento => {
                    const emprnedimientoList = document.getElementById('emprnedimientoList');
                    emprnedimientoList.innerHTML = ''; // Limpiar la lista

                    emprendimiento.forEach(emprendimiento => {
                        // Crear un elemento para cada usuario
                        const emprendimientoItem = document.createElement('div');
                        emprendimientoItem.classList.add('emprnedimiento-list');

                        // Crear el texto del usuario
                        const emprendimientoText = document.createElement('span');
                        emprendimientoText.textContent = `${emprendimiento.Nombre_Emprendimiento} (${emprendimiento.Id_Usuario} - ${emprendimiento.Id_categoria})`;

                        // Crear el botón de validación
                        const validateButton = document.createElement('button');
                        validateButton.textContent = 'Validar';
                        validateButton.onclick = () => ValidarUsuario(emprendimiento.Id_emprendimientos);

                        emprendimientoItem.appendChild(emprendimientoText);
                        emprendimientoItem.appendChild(validateButton);
                        emprnedimientoList.appendChild(emprendimientoItem);
                    });
                });
        }
        //funcion para validar emprendimientos
        function ValidarUsuario(emprendId) {
            fetch('./validaremprendimiento/validarEmpren.php?id=' + emprendId, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('emprendimiento validado exitosamente');
                        CargarEmprendimientoSinValidar(); // Recargar la lista después de validar
                    } else {
                        alert('Error al validar el emprendimiento');
                    }
                });
        }
    </script>
</body>

</html>