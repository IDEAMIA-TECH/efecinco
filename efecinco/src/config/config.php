<?php

// Configuración general
define('SITE_NAME', 'Efecinco');
define('SITE_URL', 'https://ideamia-dev.com/efecinco');
define('SITE_DESCRIPTION', 'Soluciones en Seguridad y Tecnología');

// Configuración de base de datos
$dbConfig = require_once __DIR__ . '/database.php';
define('DB_HOST', $dbConfig['host']);
define('DB_NAME', $dbConfig['dbname']);
define('DB_USER', $dbConfig['username']);
define('DB_PASS', $dbConfig['password']);
define('DB_CHARSET', $dbConfig['charset']);

// Configuración de correo
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'tu-email@gmail.com');
define('MAIL_PASSWORD', 'tu-password');
define('MAIL_ENCRYPTION', 'tls');

// Configuración de directorios
define('ROOT_PATH', dirname(__DIR__));
define('SRC_PATH', ROOT_PATH . '/src');
define('VIEWS_PATH', SRC_PATH . '/views');
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('UPLOADS_PATH', ROOT_PATH . '/uploads');

// Configuración de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);

// Configuración de zona horaria
date_default_timezone_set('America/Mexico_City');

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de seguridad
define('HASH_COST', 12);
define('TOKEN_EXPIRATION', 3600); // 1 hora en segundos

// Configuración de uploads
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);

return [
    'site_title' => 'Efecinco',
    'site_description' => 'Soluciones eléctricas profesionales',
    'site_keywords' => 'electricidad, instalaciones eléctricas, mantenimiento eléctrico',
    'site_url' => 'https://ideamia-dev.com/efecinco',
    'admin_email' => 'admin@efecinco.com',
    'whatsapp_number' => '+573123456789', // Número de WhatsApp para contacto
    'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.123456789!2d-74.123456789!3d4.123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDA3JzI0LjQiTiA3NMKwMDcnMjQuNCJX!5e0!3m2!1ses!2sco!4v1234567890',
    'contact_info' => [
        'address' => 'Calle 123 #45-67, Bogotá, Colombia',
        'phone' => '+57 1 234 5678',
        'email' => 'contacto@efecinco.com',
        'business_hours' => 'Lunes a Viernes: 8:00 AM - 6:00 PM'
    ],
    'social_media' => [
        'facebook' => 'https://facebook.com/efecinco',
        'instagram' => 'https://instagram.com/efecinco',
        'linkedin' => 'https://linkedin.com/company/efecinco'
    ],
    'database' => $dbConfig
];
