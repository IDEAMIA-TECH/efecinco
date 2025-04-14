<?php
// Verificar si mod_rewrite está habilitado
if (in_array('mod_rewrite', apache_get_modules())) {
    echo "mod_rewrite está habilitado";
} else {
    echo "mod_rewrite NO está habilitado";
}

// Verificar la configuración de PHP
echo "<pre>";
echo "PHP Version: " . phpversion() . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "</pre>";

// Verificar permisos de archivos
echo "<pre>";
echo "Permisos de .htaccess: " . substr(sprintf('%o', fileperms('.htaccess')), -4) . "\n";
echo "Permisos de index.php: " . substr(sprintf('%o', fileperms('index.php')), -4) . "\n";
echo "</pre>"; 