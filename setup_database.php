<?php
require_once 'includes/db.php';

try {
    $conexion = conectarDB();
    
    // Leer el archivo SQL
    $sql = file_get_contents('database.sql');
    
    // Dividir el archivo en consultas individuales
    $queries = array_filter(array_map('trim', explode(';', $sql)));
    
    $errores = [];
    $exitos = 0;
    
    // Ejecutar cada consulta
    foreach ($queries as $query) {
        try {
            if ($conexion->query($query)) {
                $exitos++;
            }
        } catch (Exception $e) {
            $errores[] = $e->getMessage();
        }
    }
    
    // Mostrar resultados
    echo "<h2>Resultado de la configuración de la base de datos</h2>";
    
    if ($exitos > 0) {
        echo "<p style='color: green;'>✓ Se ejecutaron $exitos consultas exitosamente.</p>";
    }
    
    if (!empty($errores)) {
        echo "<p style='color: orange;'>⚠ Se encontraron algunos errores (pueden ser normales si las tablas ya existen):</p>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
    
    // Verificar las tablas creadas
    $result = $conexion->query("SHOW TABLES");
    echo "<h3>Tablas en la base de datos:</h3>";
    echo "<ul>";
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error crítico: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?> 