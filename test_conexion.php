<?php
require_once 'includes/db.php';

try {
    // Probar la conexión básica
    $conexion = conectarDB();
    echo "<p style='color: green;'>✓ Conexión exitosa a la base de datos</p>";

    // Probar la creación de una tabla temporal
    $sql = "CREATE TEMPORARY TABLE test_table (id INT)";
    $stmt = consultaSegura($conexion, $sql);
    echo "<p style='color: green;'>✓ Creación de tabla temporal exitosa</p>";

    // Probar inserción con prepared statement
    $sql = "INSERT INTO test_table (id) VALUES (?)";
    $stmt = consultaSegura($conexion, $sql, [1]);
    echo "<p style='color: green;'>✓ Inserción con prepared statement exitosa</p>";

    // Probar consulta SELECT
    $sql = "SELECT * FROM test_table";
    $stmt = consultaSegura($conexion, $sql);
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✓ Consulta SELECT exitosa</p>";
    }

    // Probar charset
    $sql = "SHOW VARIABLES LIKE 'character_set_connection'";
    $result = $conexion->query($sql);
    $charset = $result->fetch_assoc();
    echo "<p style='color: green;'>✓ Charset de conexión: " . $charset['Value'] . "</p>";

    // Mostrar información del servidor
    echo "<p><strong>Información del servidor:</strong></p>";
    echo "<ul>";
    echo "<li>Versión del servidor: " . $conexion->server_info . "</li>";
    echo "<li>Versión del protocolo: " . $conexion->protocol_version . "</li>";
    echo "<li>Host: " . $conexion->host_info . "</li>";
    echo "</ul>";

} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

// Probar las funciones de sanitización
$input_test = "<script>alert('test')</script>";
$sanitized = sanitizarInput($input_test);
echo "<p style='color: green;'>✓ Sanitización de input exitosa: " . htmlspecialchars($sanitized) . "</p>";

// Probar escape de strings
$string_test = "O'Reilly; DROP TABLE users;--";
$escaped = escaparString($conexion, $string_test);
echo "<p style='color: green;'>✓ Escape de string exitoso: " . htmlspecialchars($escaped) . "</p>";

// Verificar tablas existentes
$sql = "SHOW TABLES";
$result = $conexion->query($sql);
echo "<p><strong>Tablas en la base de datos:</strong></p>";
echo "<ul>";
while ($row = $result->fetch_array()) {
    echo "<li>" . $row[0] . "</li>";
}
echo "</ul>";

?> 