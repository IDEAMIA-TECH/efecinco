<?php
require_once('../includes/db.php');
require_once('includes/auth.php');

// Verificar autenticación
verificarAutenticacion();

// Verificar que se haya proporcionado un ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de proyecto no válido']);
    exit;
}

$conexion = conectarDB();
$id = $_GET['id'];

// Obtener datos del proyecto
$sql = "SELECT * FROM proyectos WHERE id = ?";
$stmt = consultaSegura($conexion, $sql, [$id]);
$proyecto = $stmt->get_result()->fetch_assoc();

if (!$proyecto) {
    http_response_code(404);
    echo json_encode(['error' => 'Proyecto no encontrado']);
    exit;
}

// Obtener servicios relacionados
$sql = "SELECT servicio_id FROM proyecto_servicio WHERE proyecto_id = ?";
$stmt = consultaSegura($conexion, $sql, [$id]);
$servicios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener imágenes adicionales
$sql = "SELECT * FROM proyecto_imagenes WHERE proyecto_id = ? ORDER BY orden";
$stmt = consultaSegura($conexion, $sql, [$id]);
$imagenes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Preparar respuesta
$respuesta = [
    'id' => $proyecto['id'],
    'cliente' => $proyecto['cliente'],
    'tipo_solucion' => $proyecto['tipo_solucion'],
    'descripcion' => $proyecto['descripcion'],
    'descripcion_corta' => $proyecto['descripcion_corta'],
    'caracteristicas' => $proyecto['caracteristicas'],
    'fecha' => $proyecto['fecha'],
    'imagen' => $proyecto['imagen'],
    'destacado' => $proyecto['destacado'],
    'activo' => $proyecto['activo'],
    'servicios' => array_column($servicios, 'servicio_id'),
    'imagenes_adicionales' => $imagenes
];

// Enviar respuesta
header('Content-Type: application/json');
echo json_encode($respuesta); 