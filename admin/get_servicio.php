<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Obtener el ID del servicio
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM servicios WHERE id = ?";
    $stmt = consultaSegura($conexion, $sql, [$id]);
    $servicio = $stmt->get_result()->fetch_assoc();
    
    if ($servicio) {
        header('Content-Type: application/json');
        echo json_encode($servicio);
        exit;
    }
}

// Si no se encuentra el servicio o hay un error
header('Content-Type: application/json');
echo json_encode(['error' => 'Servicio no encontrado']);
exit; 