<?php

include 'src/controllers/conn.php';

$url = explode('/',$_SERVER['REQUEST_URI']);
$id = end($url);

$query = "SELECT Id_emprendimientos AS id, Nombre_Emprendimiento AS name, Descripcion AS description, Ubicacion AS address, RedSocial1 AS socialOne, RedSocial2 AS socialTwo FROM emprendimientos WHERE Emprendimiento_valido = 1 AND Id_emprendimientos = $id";

$error = true;

$result = $mysqli->query($query);


if ($result) {
    $business = $result->fetch_assoc();
    if($business){
        if (count($business) > 0){
            $error = false;
        }
    }
}


if($error){
    header("Location: /business/error");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
        echo( $business["name"] . '<br>');
        echo( $business["description"] . '<br>');
        echo( $business["address"] . '<br>');
        echo( $business["socialOne"] . '<br>');
        echo( $business["socialTwo"] . '<br>');
        echo( $business["description"] . '<br>');

    ?>
</head>
<body>
</body>
</html>