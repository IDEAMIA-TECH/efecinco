<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Variables para el header
$titulo_pagina = 'Gestión de Certificaciones';
$pagina_actual = 'certificaciones';

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

// Incluir el header
include('includes/header.php');
?>

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

    <!-- Modal para el formulario -->
    <div id="modalFormulario" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="tituloModal">Nueva Certificación</h3>
                <span class="close" onclick="cerrarModal()">&times;</span>
            </div>
            <form method="POST" id="formCertificacion" enctype="multipart/form-data">
                <input type="hidden" name="action" id="formAction" value="create">
                <input type="hidden" name="id" id="certificacionId">
                <input type="hidden" name="imagen_actual" id="imagenActual">
                
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="form-control"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control">
                    <small class="form-text text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="activo" name="activo" checked>
                        <label for="activo">
                            <i class="fas fa-check-circle"></i>
                            Activo
                        </label>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-outline" onclick="cerrarModal()">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow-y: auto;
    }

    .modal-content {
        background-color: #fff;
        margin: 2rem auto;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 90%;
        position: relative;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .modal-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 1.5rem;
    }

    .close {
        color: #6c757d;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close:hover {
        color: #343a40;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    @media (max-width: 768px) {
        .modal-content {
            margin: 1rem auto;
            padding: 1rem;
            width: 95%;
        }
    }
</style>

<script>
    // Inicializar TinyMCE
    tinymce.init({
        selector: '#descripcion',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300,
        menubar: false,
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; }',
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    function mostrarFormulario(accion, id = null) {
        const modal = document.getElementById("modalFormulario");
        const form = document.getElementById("formCertificacion");
        const titulo = document.getElementById("tituloModal");
        const accionInput = document.getElementById("formAction");
        const certificacionId = document.getElementById("certificacionId");

        // Configurar el formulario según la acción
        if (accion === "nuevo") {
            titulo.textContent = "Nueva Certificación";
            accionInput.value = "create";
            form.reset();
            certificacionId.value = "";
            document.getElementById("activo").checked = true;
            tinymce.get('descripcion').setContent('');
        } else {
            titulo.textContent = "Editar Certificación";
            accionInput.value = "update";
            certificacionId.value = id;
            // Aquí se cargarían los datos de la certificación
        }

        modal.style.display = "block";
    }

    function cerrarModal() {
        document.getElementById("modalFormulario").style.display = "none";
    }

    // Cerrar modal al hacer clic fuera
    window.onclick = function(event) {
        const modal = document.getElementById("modalFormulario");
        if (event.target == modal) {
            cerrarModal();
        }
    }

    // Cerrar alertas automáticamente después de 5 segundos
    setTimeout(function() {
        const alertas = document.getElementsByClassName("alert");
        for (let alerta of alertas) {
            alerta.style.display = "none";
        }
    }, 5000);
</script>

<?php
// Incluir el footer
include('includes/footer.php');
?> 