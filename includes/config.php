<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'efecinco');

// Configuración del sitio
define('SITE_NAME', 'Efecinco');
define('SITE_URL', 'http://localhost/efecinco');
define('ADMIN_EMAIL', 'admin@efecinco.com.mx');

// Configuración de rutas
define('ROOT_PATH', dirname(__DIR__));
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('UPLOADS_PATH', ROOT_PATH . '/uploads');

// Configuración de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();

// Configuración de zona horaria
date_default_timezone_set('America/Mexico_City');

// Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de seguridad
define('HASH_COST', 12);
define('TOKEN_EXPIRY', 3600); // 1 hora en segundos 