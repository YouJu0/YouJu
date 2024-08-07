<?php

// Establecer parámetros de la cookie de la sesión antes de iniciar la sesión
$cookieParams = session_get_cookie_params();
session_set_cookie_params([
  'lifetime' => 60 * 5, // El tiempo que va a estar activa la sesion, 30 segundos para probar
  'secure' => false, // Dilan, para las pruebas usamos esto en false, cuando estemos en https esto cambia a true
  'httponly' => true, // Impedir que las aplicaciones del lado del cliente accedan a cookies
  'samesite' => 'Strict' // Para que no nos roben las cookies, por seguridad mas que nada
]);
//inicia la session
session_start();
//Si ya tiene sesion la regenera
if (isset($_SESSION['sesionMain'])) {

  session_regenerate_id(true); // Vuelve a generar el ID de sesión para mejorar la seguridad
}
