<?php
// Configuración de errores y logging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Definir rutas de logs
define('LOG_DIR', __DIR__ . '/logs');
define('ERROR_LOG', LOG_DIR . '/error.log');
define('APP_LOG', LOG_DIR . '/app.log');

// Crear directorio de logs si no existe y asegurar permisos
if (!file_exists(LOG_DIR)) {
    if (!mkdir(LOG_DIR, 0777, true)) {
        die('No se pudo crear el directorio de logs');
    }
}

// Asegurar que los archivos de log existan y tengan los permisos correctos
if (!file_exists(ERROR_LOG)) {
    touch(ERROR_LOG);
    chmod(ERROR_LOG, 0666);
}
if (!file_exists(APP_LOG)) {
    touch(APP_LOG);
    chmod(APP_LOG, 0666);
}

// Función mejorada para logging
function logMessage($message, $type = 'INFO') {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] [$type] $message" . PHP_EOL;
    
    // Intentar escribir en el archivo de log
    if (file_put_contents(APP_LOG, $logMessage, FILE_APPEND) === false) {
        // Si falla, intentar escribir en error.log
        error_log("Error al escribir en app.log: $message");
    }
}

try {
    logMessage('Iniciando aplicación');
    
    // Verificar permisos de archivos
    $htaccessPath = __DIR__ . '/.htaccess';
    $indexPath = __FILE__;
    
    logMessage("Ruta .htaccess: $htaccessPath");
    logMessage("Permisos .htaccess: " . substr(sprintf('%o', fileperms($htaccessPath)), -4));
    logMessage("Permisos index.php: " . substr(sprintf('%o', fileperms($indexPath)), -4));
    logMessage("Permisos logs/: " . substr(sprintf('%o', fileperms(LOG_DIR)), -4));
    
    // Verificar si Apache puede leer .htaccess
    if (!is_readable($htaccessPath)) {
        throw new Exception('.htaccess no es legible');
    }
    
    // Verificar módulos de Apache
    if (function_exists('apache_get_modules')) {
        $modules = apache_get_modules();
        logMessage('Módulos de Apache: ' . implode(', ', $modules));
        if (!in_array('mod_rewrite', $modules)) {
            throw new Exception('mod_rewrite no está habilitado');
        }
    }
    
    // Verificar variables de entorno
    logMessage('DOCUMENT_ROOT: ' . ($_SERVER['DOCUMENT_ROOT'] ?? 'No definido'));
    logMessage('SCRIPT_FILENAME: ' . ($_SERVER['SCRIPT_FILENAME'] ?? 'No definido'));
    logMessage('REQUEST_URI: ' . ($_SERVER['REQUEST_URI'] ?? 'No definido'));
    logMessage('PHP_SELF: ' . ($_SERVER['PHP_SELF'] ?? 'No definido'));
    logMessage('SCRIPT_NAME: ' . ($_SERVER['SCRIPT_NAME'] ?? 'No definido'));
    
    session_start();
    
    // Cargar configuraciones
    logMessage('Cargando configuraciones');
    require_once __DIR__ . '/src/config/config.php';
    require_once __DIR__ . '/src/config/database.php';
    
    // Autoloader básico
    logMessage('Registrando autoloader');
    spl_autoload_register(function ($class) {
        $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    });
    
    // Manejo de errores mejorado
    set_error_handler(function($errno, $errstr, $errfile, $errline) {
        $errorMessage = "Error [$errno]: $errstr in $errfile on line $errline";
        logMessage($errorMessage, 'ERROR');
        error_log($errorMessage);
        return true;
    });
    
    // Router básico
    logMessage('Iniciando router');
    $request = $_SERVER['REQUEST_URI'];
    $basePath = '/efecinco';
    $request = str_replace($basePath, '', $request);
    $request = strtok($request, '?');
    
    logMessage("Request URI: $request");
    logMessage("Base Path: $basePath");
    
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
        logMessage("Procesando ruta: $request");
        list($controller, $method) = explode('@', $routes[$request]);
        $controllerClass = "Controllers\\$controller";
        $controllerInstance = new $controllerClass();
        $controllerInstance->$method();
    } else {
        logMessage("Ruta no encontrada: $request", 'WARNING');
        header("HTTP/1.0 404 Not Found");
        include __DIR__ . '/src/views/404.php';
    }
    
} catch (Exception $e) {
    $errorMessage = "Excepción: " . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString();
    logMessage($errorMessage, 'ERROR');
    error_log($errorMessage);
    header("HTTP/1.0 500 Internal Server Error");
    echo "Ha ocurrido un error. Por favor, intente más tarde.";
}
