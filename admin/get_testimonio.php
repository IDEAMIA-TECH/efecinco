<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Obtener el ID del testimonio
$id = $_GET['id'] ?? 0;

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de testimonio no proporcionado']);
    exit;
}

// Conectar a la base de datos
$conexion = conectarDB();

if (!$conexion) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al conectar con la base de datos']);
    exit;
}

// Preparar y ejecutar la consulta
$sql = "SELECT * FROM testimonios WHERE id = ?";
$stmt = consultaSegura($conexion, $sql, [$id]);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al preparar la consulta']);
    exit;
}

$resultado = $stmt->get_result();
$testimonio = $resultado->fetch_assoc();

if (!$testimonio) {
    http_response_code(404);
    echo json_encode(['error' => 'Testimonio no encontrado']);
    exit;
}

// Devolver los datos del testimonio
echo json_encode($testimonio);
?> 