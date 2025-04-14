<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Obtener la URL solicitada
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Determinar la página solicitada
$page = !empty($url[0]) ? $url[0] : 'home';
$action = isset($url[1]) ? $url[1] : '';
$id = isset($url[2]) ? $url[2] : '';

// Lista de páginas públicas permitidas
$publicPages = [
    'home',
    'services',
    'service',
    'projects',
    'project',
    'team',
    'contact',
    'about',
    'privacy',
    'terms'
];

// Lista de páginas de administración
$adminPages = [
    'dashboard',
    'services',
    'projects',
    'team',
    'testimonials',
    'settings'
];

// Verificar si es una página de administración
$isAdminPage = in_array($page, $adminPages);

// Si es una página de administración, verificar autenticación
if ($isAdminPage) {
    if (!isLoggedIn()) {
        redirect('admin/login.php');
    }
    $pagePath = "admin/{$page}.php";
} else {
    // Verificar si la página solicitada existe
    if (!in_array($page, $publicPages)) {
        $page = '404';
    }
    $pagePath = "pages/{$page}.php";
}

// Incluir la página solicitada
if (file_exists($pagePath)) {
    include $pagePath;
} else {
    include 'pages/404.php';
} 