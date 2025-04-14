<?php
require_once('auth.php');
$conexion = conectarDB();

$mensaje = '';
$tipo_mensaje = '';

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $cliente = $_POST['cliente'] ?? '';
                $cargo = $_POST['cargo'] ?? '';
                $empresa = $_POST['empresa'] ?? '';
                $testimonio = $_POST['testimonio'] ?? '';
                
                if (!empty($cliente) && !empty($testimonio)) {
                    $sql = "INSERT INTO testimonios (cliente, cargo, empresa, testimonio) 
                            VALUES (?, ?, ?, ?)";
                    $stmt = consultaSegura($conexion, $sql, [$cliente, $cargo, $empresa, $testimonio]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Testimonio creado exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al crear el testimonio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'update':
                $id = $_POST['id'] ?? 0;
                $cliente = $_POST['cliente'] ?? '';
                $cargo = $_POST['cargo'] ?? '';
                $empresa = $_POST['empresa'] ?? '';
                $testimonio = $_POST['testimonio'] ?? '';
                $activo = isset($_POST['activo']) ? 1 : 0;
                
                if ($id > 0 && !empty($cliente) && !empty($testimonio)) {
                    $sql = "UPDATE testimonios SET cliente = ?, cargo = ?, empresa = ?, 
                            testimonio = ?, activo = ? WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$cliente, $cargo, $empresa, 
                            $testimonio, $activo, $id]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Testimonio actualizado exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al actualizar el testimonio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'delete':
                $id = $_POST['id'] ?? 0;
                if ($id > 0) {
                    $sql = "DELETE FROM testimonios WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$id]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Testimonio eliminado exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al eliminar el testimonio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
        }
    }
}

// Obtener lista de testimonios
$sql = "SELECT * FROM testimonios ORDER BY fecha_creacion DESC";
$resultado = $conexion->query($sql);
$testimonios = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Testimonios - Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main class="admin-content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Gestión de Testimonios</h2>
                    <button class="btn btn-success" onclick="mostrarFormulario('nuevo')">
                        <i class="fas fa-plus"></i> Nuevo Testimonio
                    </button>
                </div>

                <?php if ($mensaje): ?>
                    <div class="alert alert-<?php echo $tipo_mensaje; ?> auto-dismiss">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Cargo</th>
                                <th>Empresa</th>
                                <th>Testimonio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($testimonios as $testimonio): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($testimonio['cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($testimonio['cargo']); ?></td>
                                    <td><?php echo htmlspecialchars($testimonio['empresa']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($testimonio['testimonio'], 0, 100)) . '...'; ?></td>
                                    <td>
                                        <span class="badge <?php echo $testimonio['activo'] ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $testimonio['activo'] ? 'Activo' : 'Inactivo'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="mostrarFormulario('editar', <?php echo $testimonio['id']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $testimonio['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro que desea eliminar este testimonio?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Formulario de creación/edición -->
            <div id="formularioTestimonio" class="card" style="display: none;">
                <div class="card-header">
                    <h3 id="tituloFormulario">Nuevo Testimonio</h3>
                    <button class="btn btn-secondary" onclick="ocultarFormulario()">Cancelar</button>
                </div>
                <form method="POST" id="formTestimonio">
                    <input type="hidden" name="action" id="formAction" value="create">
                    <input type="hidden" name="id" id="testimonioId">
                    
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <input type="text" id="cliente" name="cliente" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" id="cargo" name="cargo">
                    </div>
                    
                    <div class="form-group">
                        <label for="empresa">Empresa</label>
                        <input type="text" id="empresa" name="empresa">
                    </div>
                    
                    <div class="form-group">
                        <label for="testimonio">Testimonio</label>
                        <textarea id="testimonio" name="testimonio" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="activo" name="activo" checked>
                            Activo
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function mostrarFormulario(accion, id = null) {
            const formulario = document.getElementById('formularioTestimonio');
            const titulo = document.getElementById('tituloFormulario');
            const formAction = document.getElementById('formAction');
            const testimonioId = document.getElementById('testimonioId');
            
            if (accion === 'nuevo') {
                titulo.textContent = 'Nuevo Testimonio';
                formAction.value = 'create';
                testimonioId.value = '';
                document.getElementById('formTestimonio').reset();
            } else {
                titulo.textContent = 'Editar Testimonio';
                formAction.value = 'update';
                testimonioId.value = id;
                // Aquí se cargarían los datos del testimonio
            }
            
            formulario.style.display = 'block';
        }
        
        function ocultarFormulario() {
            document.getElementById('formularioTestimonio').style.display = 'none';
        }
    </script>
</body>
</html> 