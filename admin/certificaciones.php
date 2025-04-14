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
                $titulo = $_POST['titulo'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $imagen = $_FILES['imagen'] ?? null;
                
                if (!empty($titulo)) {
                    $ruta_imagen = '';
                    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                        $directorio = '../assets/images/certificaciones/';
                        if (!file_exists($directorio)) {
                            mkdir($directorio, 0777, true);
                        }
                        $nombre_archivo = uniqid() . '_' . basename($imagen['name']);
                        $ruta_imagen = $directorio . $nombre_archivo;
                        move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
                    }
                    
                    $sql = "INSERT INTO certificaciones (titulo, descripcion, imagen) VALUES (?, ?, ?)";
                    $stmt = consultaSegura($conexion, $sql, [$titulo, $descripcion, $ruta_imagen]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Certificación creada exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al crear la certificación';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'update':
                $id = $_POST['id'] ?? 0;
                $titulo = $_POST['titulo'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $imagen = $_FILES['imagen'] ?? null;
                $activo = isset($_POST['activo']) ? 1 : 0;
                
                if ($id > 0 && !empty($titulo)) {
                    $ruta_imagen = $_POST['imagen_actual'] ?? '';
                    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                        $directorio = '../assets/images/certificaciones/';
                        if (!file_exists($directorio)) {
                            mkdir($directorio, 0777, true);
                        }
                        $nombre_archivo = uniqid() . '_' . basename($imagen['name']);
                        $ruta_imagen = $directorio . $nombre_archivo;
                        move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
                    }
                    
                    $sql = "UPDATE certificaciones SET titulo = ?, descripcion = ?, imagen = ?, activo = ? WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$titulo, $descripcion, $ruta_imagen, $activo, $id]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Certificación actualizada exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al actualizar la certificación';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'delete':
                $id = $_POST['id'] ?? 0;
                if ($id > 0) {
                    // Primero obtener la ruta de la imagen para eliminarla
                    $sql = "SELECT imagen FROM certificaciones WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$id]);
                    $resultado = $stmt->get_result();
                    $certificacion = $resultado->fetch_assoc();
                    
                    if ($certificacion && $certificacion['imagen']) {
                        unlink($certificacion['imagen']);
                    }
                    
                    $sql = "DELETE FROM certificaciones WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$id]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Certificación eliminada exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al eliminar la certificación';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
        }
    }
}

// Obtener lista de certificaciones
$sql = "SELECT * FROM certificaciones ORDER BY fecha_creacion DESC";
$resultado = $conexion->query($sql);
$certificaciones = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Certificaciones - Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main class="admin-content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Gestión de Certificaciones</h2>
                    <button class="btn btn-success" onclick="mostrarFormulario('nuevo')">
                        <i class="fas fa-plus"></i> Nueva Certificación
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
                                <th>Imagen</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($certificaciones as $certificacion): ?>
                                <tr>
                                    <td>
                                        <?php if ($certificacion['imagen']): ?>
                                            <img src="<?php echo htmlspecialchars($certificacion['imagen']); ?>" 
                                                 alt="<?php echo htmlspecialchars($certificacion['titulo']); ?>"
                                                 style="max-width: 100px;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($certificacion['titulo']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($certificacion['descripcion'], 0, 100)) . '...'; ?></td>
                                    <td>
                                        <span class="badge <?php echo $certificacion['activo'] ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $certificacion['activo'] ? 'Activo' : 'Inactivo'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="mostrarFormulario('editar', <?php echo $certificacion['id']; ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $certificacion['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro que desea eliminar esta certificación?')">
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
            <div id="formularioCertificacion" class="card" style="display: none;">
                <div class="card-header">
                    <h3 id="tituloFormulario">Nueva Certificación</h3>
                    <button class="btn btn-secondary" onclick="ocultarFormulario()">Cancelar</button>
                </div>
                <form method="POST" id="formCertificacion" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="create">
                    <input type="hidden" name="id" id="certificacionId">
                    <input type="hidden" name="imagen_actual" id="imagenActual">
                    
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*">
                        <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
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
            const formulario = document.getElementById('formularioCertificacion');
            const titulo = document.getElementById('tituloFormulario');
            const formAction = document.getElementById('formAction');
            const certificacionId = document.getElementById('certificacionId');
            
            if (accion === 'nuevo') {
                titulo.textContent = 'Nueva Certificación';
                formAction.value = 'create';
                certificacionId.value = '';
                document.getElementById('formCertificacion').reset();
            } else {
                titulo.textContent = 'Editar Certificación';
                formAction.value = 'update';
                certificacionId.value = id;
                // Aquí se cargarían los datos de la certificación
            }
            
            formulario.style.display = 'block';
        }
        
        function ocultarFormulario() {
            document.getElementById('formularioCertificacion').style.display = 'none';
        }
    </script>
</body>
</html> 