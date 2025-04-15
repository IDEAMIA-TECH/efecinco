<?php
require_once('auth.php');
require_once('../includes/db.php');

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de servicio no válido']);
    exit;
}

$id = (int)$_GET['id'];
$conexion = conectarDB();

$sql = "SELECT * FROM servicios WHERE id = ?";
$stmt = consultaSegura($conexion, $sql, [$id]);
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Servicio no encontrado']);
    exit;
}

$servicio = $resultado->fetch_assoc();
echo json_encode($servicio); 