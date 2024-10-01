<?php
// Incluir la conexión a la base de datos
include 'src/controllers/conn.php';
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}
header('Content-Type: application/json');

$response = [];

try {
    // Obtener los emprendimientos desde la base de datos
    $query = "SELECT Id_emprendimientos AS id, Nombre_Emprendimiento, Descripcion, Ubicacion, RedSocial1, RedSocial2 FROM emprendimientos WHERE Emprendimiento_valido = 1"; // Filtrar solo los emprendimientos válidos
    $result = $mysqli->query($query);

    if ($result) {
        $emprendimientos = [];
        while ($row = $result->fetch_assoc()) {
            $emprendimientos[] = $row;
        }
        $response['data'] = $emprendimientos;
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = 'Error en la consulta: ' . $mysqli->error;
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response) ;
$mysqli->close();
?>