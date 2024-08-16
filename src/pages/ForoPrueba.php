<?php
session_start();

if(!isset($_SESSION['sesionMain'])){

header('Location: ./login.php?error=para ingresar a los foros debe estar logeado');

}

include("../conexion.php");

// Manejo de nuevos mensajes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = mysqli_real_escape_string($mysqli, $_POST['message']);

    $id = $_SESSION['sesionMain']['id'];


//seguir con esto tengo que ajustar las tablas y las querys, dale vago, labura



    $query = "INSERT INTO mensajes (`Id_mensaje`,`Id_Usuario`, `Mensaje`,) VALUES ('$id', '$message')";
    mysqli_query($mysqli, $query);
}

// Obtener mensajes
$query = "SELECT * FROM mensajes ORDER BY Fecha_mensajes DESC";
$result = mysqli_query($mysqli, $query);
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
    <div class="chat-box">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="message">
                <span class="username"><?php echo htmlspecialchars($row['username']); ?>:</span>
                <span><?php echo htmlspecialchars($row['message']); ?></span>
                <br>
                <small><?php echo $row['created_at']; ?></small>
            </div>
        <?php } ?>
    </div>
    <form method="post">

        <br>
        <label for="message">Mensaje:</label>
        <textarea id="message" name="message" rows="3" required></textarea>
        <br>
        <button type="submit">Enviar</button>
    </form>
    <script>
        // Auto actualizar el chat cada 5 segundos
        setInterval(function() {
            location.reload();
        }, 5000);
    </script>
</body>
</html>
