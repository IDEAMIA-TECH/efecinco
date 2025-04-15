<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Variables para el header
$titulo_pagina = 'Gestión de Testimonios';
$pagina_actual = 'testimonios';

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

// Incluir el header
include('includes/header.php');
?>

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

<div class="container">
    <div class="header">
        <h1>Gestión de Testimonios</h1>
        <button class="btn btn-primary" onclick="mostrarFormulario('crear')">
            <i class="fas fa-plus"></i> Nuevo Testimonio
        </button>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $tipo_mensaje; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <!-- Tabla de testimonios -->
    <div class="card">
        <div class="card-body">
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
    </div>

    <!-- Modal de formulario -->
    <div id="modalFormulario" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="tituloModal">Nuevo Testimonio</h3>
                <span class="close" onclick="cerrarModal()">&times;</span>
            </div>
            <form id="formTestimonio" method="POST">
                <input type="hidden" name="action" id="formAction" value="create">
                <input type="hidden" name="id" id="testimonioId">
                
                <div class="form-group">
                    <label for="cliente">Cliente</label>
                    <input type="text" id="cliente" name="cliente" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" id="cargo" name="cargo" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="empresa">Empresa</label>
                    <input type="text" id="empresa" name="empresa" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="testimonio">Testimonio</label>
                    <textarea id="testimonio" name="testimonio" rows="4" class="form-control" required></textarea>
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

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/4u89qw1ptzfqell0ybjhqth1cc16ilb1y0792h3momw4lk8l/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#testimonio',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300,
        menubar: false,
        language: 'es',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    function mostrarFormulario(accion, id = null) {
        const modal = document.getElementById("modalFormulario");
        const form = document.getElementById("formTestimonio");
        const titulo = document.getElementById("tituloModal");
        const accionInput = document.getElementById("formAction");
        const testimonioId = document.getElementById("testimonioId");

        // Configurar el formulario según la acción
        if (accion === "crear") {
            titulo.textContent = "Nuevo Testimonio";
            accionInput.value = "create";
            form.reset();
            testimonioId.value = "";
            document.getElementById("activo").checked = true;
            tinymce.get('testimonio').setContent('');
        } else {
            titulo.textContent = "Editar Testimonio";
            accionInput.value = "update";
            testimonioId.value = id;

            // Cargar datos del testimonio
            fetch(`get_testimonio.php?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById("cliente").value = data.cliente;
                    document.getElementById("cargo").value = data.cargo;
                    document.getElementById("empresa").value = data.empresa;
                    tinymce.get('testimonio').setContent(data.testimonio);
                    document.getElementById("activo").checked = data.activo == 1;
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Error al cargar los datos del testimonio");
                });
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