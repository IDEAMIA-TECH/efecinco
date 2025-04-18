<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Variables para el header
$titulo_pagina = 'Gestión de Servicios';
$pagina_actual = 'servicios';

// Incluir el header
include('includes/header.php');

$mensaje = '';
$tipo_mensaje = '';

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                error_log("Iniciando proceso de creación de servicio");
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $icono = $_POST['icono'] ?? '';
                $orden = intval($_POST['orden'] ?? 0);
                $activo = isset($_POST['activo']) ? 1 : 0;
                
                error_log("Datos recibidos - Nombre: $nombre, Icono: $icono, Orden: $orden, Activo: $activo");
                
                if (!empty($nombre)) {
                    try {
                        $sql = "INSERT INTO servicios (nombre, descripcion, icono, orden, activo) VALUES (?, ?, ?, ?, ?)";
                        error_log("SQL a ejecutar: $sql");
                        
                        $stmt = consultaSegura($conexion, $sql, [$nombre, $descripcion, $icono, $orden, $activo]);
                        error_log("Consulta ejecutada, filas afectadas: " . $stmt->affected_rows);
                        
                        if ($stmt->affected_rows > 0) {
                            error_log("Servicio creado exitosamente");
                            header("Location: servicios.php?mensaje=creado&tipo=success");
                            exit;
                        } else {
                            error_log("Error: No se pudo crear el servicio - No se afectaron filas");
                            $mensaje = 'Error al crear el servicio';
                            $tipo_mensaje = 'danger';
                        }
                    } catch (Exception $e) {
                        error_log("Error al crear servicio: " . $e->getMessage());
                        $mensaje = 'Error al crear el servicio: ' . $e->getMessage();
                        $tipo_mensaje = 'danger';
                    }
                } else {
                    error_log("Error: Nombre de servicio vacío");
                    $mensaje = 'El nombre del servicio es requerido';
                    $tipo_mensaje = 'danger';
                }
                break;
                
            case 'update':
                $id = intval($_POST['id'] ?? 0);
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $icono = $_POST['icono'] ?? '';
                $orden = intval($_POST['orden'] ?? 0);
                $activo = isset($_POST['activo']) ? 1 : 0;
                
                if ($id > 0 && !empty($nombre)) {
                    $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, icono = ?, orden = ?, activo = ? WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$nombre, $descripcion, $icono, $orden, $activo, $id]);
                    
                    if ($stmt->affected_rows > 0) {
                        header("Location: servicios.php?mensaje=actualizado&tipo=success");
                        exit;
                    } else {
                        $mensaje = 'Error al actualizar el servicio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'delete':
                $id = intval($_POST['id'] ?? 0);
                if ($id > 0) {
                    $sql = "DELETE FROM servicios WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$id]);
                    
                    if ($stmt->affected_rows > 0) {
                        header("Location: servicios.php?mensaje=eliminado&tipo=success");
                        exit;
                    } else {
                        $mensaje = 'Error al eliminar el servicio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
        }
    }
}

// Obtener lista de servicios
$sql = "SELECT * FROM servicios ORDER BY orden ASC, nombre ASC";
$resultado = $conexion->query($sql);
$servicios = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
    <div class="header">
        <h1>Gestión de Servicios</h1>
        <button class="btn btn-primary" onclick="mostrarFormulario('crear')">
            <i class="fas fa-plus"></i> Nuevo Servicio
        </button>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $tipo_mensaje; ?> auto-dismiss">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <div id="formularioServicio" style="display: none;" class="card mb-4">
        <div class="card-header">
            <h3 id="formularioServicioTitulo">Nuevo Servicio</h3>
            <button class="btn btn-secondary" onclick="ocultarFormulario()">Cancelar</button>
        </div>
        <form method="POST" id="formServicio">
            <input type="hidden" name="action" id="formAction" value="create">
            <input type="hidden" name="id" id="servicioId">
            
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="5"></textarea>
            </div>
            
            <div class="form-group">
                <label for="icono">Icono (Font Awesome)</label>
                <select id="icono" name="icono" class="form-control">
                    <option value="fas fa-network-wired">Cableado Estructurado</option>
                    <option value="fas fa-video">CCTV / Cámaras</option>
                    <option value="fas fa-door-closed">Control de Acceso</option>
                    <option value="fas fa-wifi">Redes Inalámbricas</option>
                    <option value="fas fa-phone">Telefonía IP</option>
                    <option value="fas fa-headset">Soporte Técnico</option>
                    <option value="fas fa-server">Servidores</option>
                    <option value="fas fa-database">Backup</option>
                    <option value="fas fa-volume-up">Audio Ambiental</option>
                    <option value="fas fa-laptop">Equipos y Tecnología</option>
                    <option value="fas fa-cogs">Otros</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="orden">Orden</label>
                <input type="number" id="orden" name="orden" class="form-control" min="0" value="0" required>
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

    <!-- Tabla de servicios -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Icono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicios as $servicio): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($servicio['orden']); ?></td>
                                <td><?php echo htmlspecialchars($servicio['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($servicio['descripcion']); ?></td>
                                <td><i class="<?php echo htmlspecialchars($servicio['icono']); ?>"></i></td>
                                <td>
                                    <span class="badge <?php echo $servicio['activo'] ? 'badge-success' : 'badge-danger'; ?>">
                                        <?php echo $servicio['activo'] ? 'Activo' : 'Inactivo'; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick="mostrarFormulario('editar', <?php echo $servicio['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro que desea eliminar este servicio?')">
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
</div>

<?php
// Scripts adicionales para TinyMCE y manejo del formulario
$scripts_adicionales = '
<script src="https://cdn.tiny.cloud/1/4u89qw1ptzfqell0ybjhqth1cc16ilb1y0792h3momw4lk8l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Inicializar TinyMCE
    function initTinyMCE() {
        tinymce.init({
            selector: "#descripcion",
            plugins: "advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount",
            toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
            height: 300
        });
    }

    // Función para mostrar/ocultar formulario
    function mostrarFormulario(accion, id = null) {
        const formulario = document.getElementById("formularioServicio");
        formulario.style.display = "block";
        document.getElementById("formAction").value = accion;
        
        // Scroll suave al formulario
        formulario.scrollIntoView({ behavior: "smooth" });

        if (accion === "crear") {
            document.getElementById("formularioServicioTitulo").textContent = "Crear Nuevo Servicio";
            document.getElementById("formServicio").reset();
            document.getElementById("activo").checked = true;
            document.getElementById("orden").value = "0";
            tinymce.get("descripcion").setContent("");
        } else if (accion === "editar" && id) {
            document.getElementById("formularioServicioTitulo").textContent = "Editar Servicio";
            document.getElementById("servicioId").value = id;
            
            // Cargar datos del servicio
            fetch(`get_servicio.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById("nombre").value = data.nombre || "";
                        document.getElementById("descripcion").value = data.descripcion || "";
                        document.getElementById("icono").value = data.icono || "";
                        document.getElementById("orden").value = data.orden || 0;
                        document.getElementById("activo").checked = data.activo == 1;
                        tinymce.get("descripcion").setContent(data.descripcion || "");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Error al cargar los datos del servicio");
                });
        }
    }

    function ocultarFormulario() {
        document.getElementById("formularioServicio").style.display = "none";
    }

    // Inicializar TinyMCE al cargar la página
    document.addEventListener("DOMContentLoaded", function() {
        initTinyMCE();
    });

    // Cerrar alertas automáticamente después de 5 segundos
    setTimeout(function() {
        const alertas = document.getElementsByClassName("alert");
        for (let alerta of alertas) {
            alerta.style.display = "none";
        }
    }, 5000);
</script>
';

// Incluir el footer
include('includes/footer.php');
?> 