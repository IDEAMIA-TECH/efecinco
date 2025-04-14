<?php
session_start();

// Cargar configuraciones
require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/config/database.php';

// Autoloader básico
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Manejo de errores
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    error_log("Error [$errno]: $errstr in $errfile on line $errline");
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        echo "Error [$errno]: $errstr in $errfile on line $errline";
    } else {
        echo "Ha ocurrido un error. Por favor, intente más tarde.";
    }
    return true;
});

// Router básico
$request = $_SERVER['REQUEST_URI'];
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$request = str_replace($basePath, '', $request);
$request = strtok($request, '?');

// Rutas básicas
$routes = [
    '/' => 'HomeController@index',
    '/quienes-somos' => 'AboutController@index',
    '/servicios' => 'ServicesController@index',
    '/proyectos' => 'ProjectsController@index',
    '/contacto' => 'ContactController@index',
    '/admin' => 'AdminController@index',
    '/admin/login' => 'AdminController@login',
    '/admin/logout' => 'AdminController@logout'
];

// Procesar la ruta
if (isset($routes[$request])) {
    list($controller, $method) = explode('@', $routes[$request]);
    $controllerClass = "Controllers\\$controller";
    $controllerInstance = new $controllerClass();
    $controllerInstance->$method();
} else {
    // Página no encontrada
    header("HTTP/1.0 404 Not Found");
    include __DIR__ . '/src/views/404.php';
}
