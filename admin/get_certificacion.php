<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Obtener el ID de la certificación
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode(['error' => 'ID de certificación inválido']);
    exit;
}

// Conectar a la base de datos
$conexion = conectarDB();

if (!$conexion) {
    echo json_encode(['error' => 'Error al conectar con la base de datos']);
    exit;
}

// Obtener los datos de la certificación
$sql = "SELECT * FROM certificaciones WHERE id = ?";
$stmt = consultaSegura($conexion, $sql, [$id]);

if (!$stmt) {
    echo json_encode(['error' => 'Error al ejecutar la consulta']);
    exit;
}

$resultado = $stmt->get_result();
$certificacion = $resultado->fetch_assoc();

if (!$certificacion) {
    echo json_encode(['error' => 'Certificación no encontrada']);
    exit;
}

// Devolver los datos en formato JSON
echo json_encode($certificacion);
?> 
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Obtener el ID de la certificación
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode(['error' => 'ID de certificación inválido']);
    exit;
}

// Conectar a la base de datos
$conexion = conectarDB();

if (!$conexion) {
    echo json_encode(['error' => 'Error al conectar con la base de datos']);
    exit;
}

// Obtener los datos de la certificación
$sql = "SELECT * FROM certificaciones WHERE id = ?";
$stmt = consultaSegura($conexion, $sql, [$id]);

if (!$stmt) {
    echo json_encode(['error' => 'Error al ejecutar la consulta']);
    exit;
}

$resultado = $stmt->get_result();
$certificacion = $resultado->fetch_assoc();

if (!$certificacion) {
    echo json_encode(['error' => 'Certificación no encontrada']);
    exit;
}

// Devolver los datos en formato JSON
echo json_encode($certificacion);
?> 