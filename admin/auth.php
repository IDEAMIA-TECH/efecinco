<?php
session_start();
require_once('../includes/db.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Función para obtener el nombre del usuario actual
function getCurrentAdminName() {
    return $_SESSION['admin_nombre'] ?? 'Administrador';
}

// Función para cerrar sesión
function logout() {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Manejar la solicitud de cierre de sesión
if (isset($_GET['logout'])) {
    logout();
}
?> 