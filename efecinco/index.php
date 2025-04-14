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

// Configuración de sesión
ini_set('session.cookie_lifetime', 86400); // 24 horas
ini_set('session.gc_maxlifetime', 86400); // 24 horas
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Iniciar sesión
session_start();

try {
    logMessage('Iniciando aplicación');
    
    // Cargar configuraciones
    logMessage('Cargando configuraciones');
    require_once __DIR__ . '/src/config/config.php';
    require_once __DIR__ . '/src/config/database.php';
    
    // Verificar estructura de directorios
    logMessage("Verificando estructura de directorios:");
    logMessage("ROOT_PATH existe: " . (is_dir(ROOT_PATH) ? 'Sí' : 'No'));
    logMessage("SRC_PATH existe: " . (is_dir(SRC_PATH) ? 'Sí' : 'No'));
    logMessage("CONTROLLERS_PATH existe: " . (is_dir(CONTROLLERS_PATH) ? 'Sí' : 'No'));
    logMessage("VIEWS_PATH existe: " . (is_dir(VIEWS_PATH) ? 'Sí' : 'No'));
    
    // Listar contenido de directorios de forma segura
    function safeScandir($path) {
        if (!is_dir($path)) {
            logMessage("Directorio no existe: $path", 'WARNING');
            return [];
        }
        $result = scandir($path);
        if ($result === false) {
            logMessage("Error al escanear directorio: $path", 'WARNING');
            return [];
        }
        return $result;
    }
    
    // Listar contenido de directorios
    $rootContent = safeScandir(ROOT_PATH);
    logMessage("Contenido de ROOT_PATH: " . implode(', ', $rootContent));
    
    $srcContent = safeScandir(SRC_PATH);
    logMessage("Contenido de SRC_PATH: " . implode(', ', $srcContent));
    
    // Verificar que los directorios existan
    if (!is_dir(CONTROLLERS_PATH)) {
        $error = "El directorio de controladores no existe: " . CONTROLLERS_PATH;
        logMessage($error, 'ERROR');
        throw new \Exception($error);
    }
    
    if (!is_dir(VIEWS_PATH)) {
        $error = "El directorio de vistas no existe: " . VIEWS_PATH;
        logMessage($error, 'ERROR');
        throw new \Exception($error);
    }
    
    // Autoloader mejorado
    logMessage('Registrando autoloader');
    spl_autoload_register(function ($class) {
        $prefix = 'Controllers\\';
        $base_dir = CONTROLLERS_PATH . '/';
        
        // Verificar si la clase pertenece al namespace Controllers
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }
        
        // Obtener el nombre relativo de la clase
        $relative_class = substr($class, $len);
        
        // Reemplazar namespace separators con directory separators
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        
        logMessage("Intentando cargar clase: $class");
        logMessage("Ruta del archivo: $file");
        
        // Si el archivo existe, cargarlo
        if (file_exists($file)) {
            logMessage("Archivo encontrado: $file");
            require $file;
        } else {
            $error = "Clase no encontrada: $class en $file";
            logMessage($error, 'ERROR');
            throw new \Exception($error);
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
        
        logMessage("Intentando instanciar controlador: $controllerClass");
        
        if (!class_exists($controllerClass)) {
            throw new \Exception("Controlador no encontrado: $controllerClass");
        }
        
        $controllerInstance = new $controllerClass();
        if (!method_exists($controllerInstance, $method)) {
            throw new \Exception("Método no encontrado: $method en $controllerClass");
        }
        
        $controllerInstance->$method();
    } else {
        logMessage("Ruta no encontrada: $request", 'WARNING');
        if (!headers_sent()) {
            header("HTTP/1.0 404 Not Found");
        }
        include VIEWS_PATH . '/404.php';
    }
    
} catch (\Exception $e) {
    $errorMessage = "Excepción: " . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString();
    logMessage($errorMessage, 'ERROR');
    error_log($errorMessage);
    
    // Intentar mostrar la página de error
    if (class_exists('Controllers\\HomeController')) {
        $controller = new \Controllers\HomeController();
        $controller->error();
    } else {
        if (!headers_sent()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        echo "Ha ocurrido un error. Por favor, intente más tarde.";
    }
}
