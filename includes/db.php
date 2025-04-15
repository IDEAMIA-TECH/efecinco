<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'efecinco_db');

// Función para conectar a la base de datos
function conectarDB() {
    $host = 'localhost';
    $usuario = 'ideamiadev_efecinco';
    $password = '8hps$N6!jiihyPtQ';
    $database = 'ideamiadev_efecinco';

    // Crear conexión con manejo de errores
    try {
        $conexion = new mysqli($host, $usuario, $password, $database);

        // Verificar conexión
        if ($conexion->connect_error) {
            throw new Exception("Error de conexión: " . $conexion->connect_error);
        }

        // Establecer charset
        $conexion->set_charset("utf8mb4");

        return $conexion;
    } catch (Exception $e) {
        // Log del error
        error_log("Error de conexión a la base de datos: " . $e->getMessage());
        
        // Mensaje genérico para el usuario
        die("Error al conectar con la base de datos. Por favor, contacte al administrador.");
    }
}

// Función para ejecutar consultas seguras
function consultaSegura($conexion, $sql, $params = []) {
    try {
        $stmt = $conexion->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        if (!empty($params)) {
            // Determinar los tipos de datos para bind_param
            $tipos = '';
            foreach ($params as $param) {
                if (is_int($param)) $tipos .= 'i';
                elseif (is_float($param)) $tipos .= 'd';
                elseif (is_string($param)) $tipos .= 's';
                else $tipos .= 'b';
            }

            // Hacer bind de los parámetros
            $stmt->bind_param($tipos, ...$params);
        }

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        return $stmt;
    } catch (Exception $e) {
        error_log("Error en la consulta: " . $e->getMessage());
        die("Error al procesar la solicitud. Por favor, contacte al administrador.");
    }
}

// Función para escapar strings (uso en casos donde prepared statements no son prácticos)
function escaparString($conexion, $string) {
    return $conexion->real_escape_string(strip_tags($string));
}

// Función para validar y sanitizar inputs
function sanitizarInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
} 