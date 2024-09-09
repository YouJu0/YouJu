<?php
function route($route, $path_to_include, $type = 'php')
{
	$is_callback = is_callable($path_to_include);

	// Asegura que el path_to_include tenga la extensión correcta
	if (!$is_callback && pathinfo($path_to_include, PATHINFO_EXTENSION) !== $type) {
		$path_to_include .= ".$type";
	}

	// Manejo de la ruta 404
	if ($route === "/404") {
		include_once __DIR__ . "/$path_to_include";
		exit();
	}

	// Normaliza la URL solicitada
	$request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
	$request_url = rtrim($request_url, '/');
	$request_url = strtok($request_url, '?');

	// Divide la ruta y la URL solicitada en partes
	$route_parts = array_filter(explode('/', $route));
	$request_url_parts = array_filter(explode('/', $request_url));

	// Compara la longitud de las partes
	if (count($route_parts) !== count($request_url_parts)) {
		return;
	}

	// Compara cada parte y recolecta parámetros
	$parameters = [];
	foreach ($route_parts as $index => $route_part) {
		$request_part = $request_url_parts[$index] ?? '';

		if ($route_part[0] === '$') {
			$param_name = ltrim($route_part, '$');
			$parameters[] = $request_part;
			$$param_name = $request_part; // Asigna parámetros dinámicos
		} elseif ($route_part !== $request_part) {
			return;
		}
	}

	// Ejecuta la función callback si es necesario, o incluye el archivo
	if ($is_callback) {
		call_user_func_array($path_to_include, $parameters);
	} else {
		$file_path = __DIR__ . "/$path_to_include";
		if (file_exists($file_path)) {
			include_once $file_path;
		} else {
			http_response_code(404);
			echo "Archivo no encontrado: $file_path";
		}
	}
	exit();
}

// Maneja los métodos HTTP
function get($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		route($route, $path_to_include);
	}
}
function post($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		route($route, $path_to_include);
	}
}
function put($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
		route($route, $path_to_include);
	}
}
function patch($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
		route($route, $path_to_include);
	}
}
function delete($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		route($route, $path_to_include);
	}
}
function any($route, $path_to_include)
{
	route($route, $path_to_include);
}
// Maneja archivos CSS y WebP
function style($route, $path_to_include)
{
	route($route, $path_to_include, 'css');
}
function webp($route, $path_to_include)
{
	route($route, $path_to_include, 'webp');
}

// CSRF Functions
function set_csrf()
{
	session_start();
	if (!isset($_SESSION["csrf"])) {
		$_SESSION["csrf"] = bin2hex(random_bytes(50));
	}
	echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function is_csrf_valid()
{
	session_start();
	if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
		return false;
	}
	return $_SESSION['csrf'] === $_POST['csrf'];
}
