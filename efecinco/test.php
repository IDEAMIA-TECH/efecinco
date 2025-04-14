<?php
header('Content-Type: text/plain');

echo "=== Información del Servidor ===\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n\n";

echo "=== Permisos de Archivos ===\n";
$files = [
    '.htaccess',
    'index.php',
    'test.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "$file: " . substr(sprintf('%o', fileperms($file)), -4) . "\n";
    } else {
        echo "$file: No existe\n";
    }
}

echo "\n=== Módulos de Apache ===\n";
if (function_exists('apache_get_modules')) {
    echo implode("\n", apache_get_modules());
} else {
    echo "No se puede obtener información de módulos de Apache";
}

echo "\n\n=== Variables de Entorno ===\n";
echo "PATH: " . getenv('PATH') . "\n";
echo "USER: " . getenv('USER') . "\n";
echo "HOME: " . getenv('HOME') . "\n";

echo "\n=== Información de PHP ===\n";
echo "error_reporting: " . ini_get('error_reporting') . "\n";
echo "display_errors: " . ini_get('display_errors') . "\n";
echo "log_errors: " . ini_get('log_errors') . "\n";
echo "error_log: " . ini_get('error_log') . "\n"; 