<?php
ob_start(); // Start output buffering
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Variables para el header
$titulo_pagina = 'Administrar Proyectos';
$pagina_actual = 'proyectos';

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = $_POST['id'] ?? 0;

    switch ($accion) {
        case 'crear':
            $cliente = $_POST['cliente'] ?? '';
            $tipo_solucion = $_POST['tipo_solucion'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $descripcion_corta = $_POST['descripcion_corta'] ?? '';
            $caracteristicas = $_POST['caracteristicas'] ?? '';
            $fecha = $_POST['fecha'] ?? date('Y-m-d');
            $destacado = isset($_POST['destacado']) ? 1 : 0;
            $activo = isset($_POST['activo']) ? 1 : 0;

            // Procesar imagen
            $imagen = '';
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorio = '../assets/images/proyectos/';
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                $nombre_archivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $ruta_archivo = $directorio . $nombre_archivo;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo)) {
                    $imagen = 'assets/images/proyectos/' . $nombre_archivo;
                }
            }

            $sql = "INSERT INTO proyectos (cliente, tipo_solucion, descripcion, descripcion_corta, caracteristicas, fecha, imagen, destacado, activo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = consultaSegura($conexion, $sql, [
                $cliente, $tipo_solucion, $descripcion, $descripcion_corta, 
                $caracteristicas, $fecha, $imagen, $destacado, $activo
            ]);

            if ($stmt->affected_rows > 0) {
                $proyecto_id = $conexion->insert_id;

                // Procesar servicios relacionados
                if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
                    foreach ($_POST['servicios'] as $servicio_id) {
                        $sql = "INSERT INTO proyecto_servicio (proyecto_id, servicio_id) VALUES (?, ?)";
                        consultaSegura($conexion, $sql, [$proyecto_id, $servicio_id]);
                    }
                }

                // Procesar imágenes adicionales
                if (isset($_FILES['imagenes_adicionales'])) {
                    $directorio = '../assets/images/proyectos/';
                    foreach ($_FILES['imagenes_adicionales']['tmp_name'] as $key => $tmp_name) {
                        if ($_FILES['imagenes_adicionales']['error'][$key] === UPLOAD_ERR_OK) {
                            $nombre_archivo = uniqid() . '_' . basename($_FILES['imagenes_adicionales']['name'][$key]);
                            $ruta_archivo = $directorio . $nombre_archivo;

                            if (move_uploaded_file($tmp_name, $ruta_archivo)) {
                                $sql = "INSERT INTO proyecto_imagenes (proyecto_id, url, descripcion, orden) 
                                        VALUES (?, ?, ?, ?)";
                                consultaSegura($conexion, $sql, [
                                    $proyecto_id,
                                    'assets/images/proyectos/' . $nombre_archivo,
                                    $_POST['descripciones_imagenes'][$key] ?? '',
                                    $key
                                ]);
                            }
                        }
                    }
                }

                header('Location: proyectos.php?mensaje=creado');
                exit;
            }
            break;

        case 'actualizar':
            $cliente = $_POST['cliente'] ?? '';
            $tipo_solucion = $_POST['tipo_solucion'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $descripcion_corta = $_POST['descripcion_corta'] ?? '';
            $caracteristicas = $_POST['caracteristicas'] ?? '';
            $fecha = $_POST['fecha'] ?? date('Y-m-d');
            $destacado = isset($_POST['destacado']) ? 1 : 0;
            $activo = isset($_POST['activo']) ? 1 : 0;

            // Procesar imagen
            $imagen = $_POST['imagen_actual'] ?? '';
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorio = '../assets/images/proyectos/';
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                $nombre_archivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $ruta_archivo = $directorio . $nombre_archivo;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo)) {
                    // Eliminar imagen anterior si existe
                    if ($imagen && file_exists('../' . $imagen)) {
                        unlink('../' . $imagen);
                    }
                    $imagen = 'assets/images/proyectos/' . $nombre_archivo;
                }
            }

            $sql = "UPDATE proyectos SET 
                    cliente = ?, tipo_solucion = ?, descripcion = ?, 
                    descripcion_corta = ?, caracteristicas = ?, fecha = ?, 
                    imagen = ?, destacado = ?, activo = ? 
                    WHERE id = ?";
            $stmt = consultaSegura($conexion, $sql, [
                $cliente, $tipo_solucion, $descripcion, $descripcion_corta, 
                $caracteristicas, $fecha, $imagen, $destacado, $activo, $id
            ]);

            if ($stmt->affected_rows > 0) {
                // Actualizar servicios relacionados
                $sql = "DELETE FROM proyecto_servicio WHERE proyecto_id = ?";
                consultaSegura($conexion, $sql, [$id]);

                if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
                    foreach ($_POST['servicios'] as $servicio_id) {
                        $sql = "INSERT INTO proyecto_servicio (proyecto_id, servicio_id) VALUES (?, ?)";
                        consultaSegura($conexion, $sql, [$id, $servicio_id]);
                    }
                }

                // Procesar nuevas imágenes adicionales
                if (isset($_FILES['imagenes_adicionales'])) {
                    $directorio = '../assets/images/proyectos/';
                    foreach ($_FILES['imagenes_adicionales']['tmp_name'] as $key => $tmp_name) {
                        if ($_FILES['imagenes_adicionales']['error'][$key] === UPLOAD_ERR_OK) {
                            $nombre_archivo = uniqid() . '_' . basename($_FILES['imagenes_adicionales']['name'][$key]);
                            $ruta_archivo = $directorio . $nombre_archivo;

                            if (move_uploaded_file($tmp_name, $ruta_archivo)) {
                                $sql = "INSERT INTO proyecto_imagenes (proyecto_id, url, descripcion, orden) 
                                        VALUES (?, ?, ?, ?)";
                                consultaSegura($conexion, $sql, [
                                    $id,
                                    'assets/images/proyectos/' . $nombre_archivo,
                                    $_POST['descripciones_imagenes'][$key] ?? '',
                                    $key
                                ]);
                            }
                        }
                    }
                }

                header('Location: proyectos.php?mensaje=actualizado');
                exit;
            }
            break;

        case 'eliminar':
            // Obtener información del proyecto para eliminar imágenes
            $sql = "SELECT imagen FROM proyectos WHERE id = ?";
            $stmt = consultaSegura($conexion, $sql, [$id]);
            $proyecto = $stmt->get_result()->fetch_assoc();

            // Eliminar imagen principal si existe
            if ($proyecto['imagen'] && file_exists('../' . $proyecto['imagen'])) {
                unlink('../' . $proyecto['imagen']);
            }

            // Eliminar imágenes adicionales
            $sql = "SELECT url FROM proyecto_imagenes WHERE proyecto_id = ?";
            $stmt = consultaSegura($conexion, $sql, [$id]);
            $imagenes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            foreach ($imagenes as $imagen) {
                if (file_exists('../' . $imagen['url'])) {
                    unlink('../' . $imagen['url']);
                }
            }

            // Eliminar registros de la base de datos
            $sql = "DELETE FROM proyecto_servicio WHERE proyecto_id = ?";
            consultaSegura($conexion, $sql, [$id]);

            $sql = "DELETE FROM proyecto_imagenes WHERE proyecto_id = ?";
            consultaSegura($conexion, $sql, [$id]);

            $sql = "DELETE FROM proyectos WHERE id = ?";
            $stmt = consultaSegura($conexion, $sql, [$id]);

            if ($stmt->affected_rows > 0) {
                header('Location: proyectos.php?mensaje=eliminado');
                exit;
            }
            break;
    }
}

// Obtener proyectos
$sql = "SELECT * FROM proyectos ORDER BY fecha DESC";
$stmt = consultaSegura($conexion, $sql, []);
$proyectos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener servicios para el formulario
$sql = "SELECT * FROM servicios WHERE activo = 1 ORDER BY nombre";
$stmt = consultaSegura($conexion, $sql, []);
$servicios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Incluir el header
include('includes/header.php');
?>

<div class="container">
    <div class="header">
        <h1>Administrar Proyectos</h1>
        <button class="btn btn-primary" onclick="mostrarFormulario('crear')">
            <i class="fas fa-plus"></i> Nuevo Proyecto
        </button>
    </div>

    <?php if (isset($_GET['mensaje'])): ?>
        <?php
        $mensajes = [
            'creado' => ['Proyecto creado exitosamente', 'success'],
            'actualizado' => ['Proyecto actualizado exitosamente', 'success'],
            'eliminado' => ['Proyecto eliminado exitosamente', 'success']
        ];
        $mensaje = $mensajes[$_GET['mensaje']] ?? ['Ha ocurrido un error', 'danger'];
        ?>
        <div class="alert alert-<?php echo $mensaje[1]; ?>">
            <?php echo $mensaje[0]; ?>
        </div>
    <?php endif; ?>

    <div class="projects-grid">
        <?php foreach ($proyectos as $proyecto): ?>
            <div class="project-card">
                <div class="project-image">
                    <?php if ($proyecto['imagen']): ?>
                        <img src="../<?php echo htmlspecialchars($proyecto['imagen']); ?>" alt="<?php echo htmlspecialchars($proyecto['cliente']); ?>">
                    <?php else: ?>
                        <div class="no-image">
                            <i class="fas fa-image"></i>
                        </div>
                    <?php endif; ?>
                    <div class="project-status <?php echo $proyecto['activo'] ? 'active' : 'inactive'; ?>">
                        <?php echo $proyecto['activo'] ? 'Activo' : 'Inactivo'; ?>
                    </div>
                    <?php if ($proyecto['destacado']): ?>
                        <div class="project-featured">
                            <i class="fas fa-star"></i> Destacado
                        </div>
                    <?php endif; ?>
                </div>
                <div class="project-content">
                    <h3><?php echo htmlspecialchars($proyecto['cliente']); ?></h3>
                    <p class="project-type"><?php echo htmlspecialchars($proyecto['tipo_solucion']); ?></p>
                    <p class="project-date">
                        <i class="far fa-calendar-alt"></i>
                        <?php echo date('d/m/Y', strtotime($proyecto['fecha'])); ?>
                    </p>
                    <p class="project-description">
                        <?php echo htmlspecialchars(substr($proyecto['descripcion_corta'], 0, 100)) . '...'; ?>
                    </p>
                    <div class="project-actions">
                        <button class="btn btn-edit" onclick="mostrarFormulario('editar', <?php echo $proyecto['id']; ?>)">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-delete" onclick="eliminarProyecto(<?php echo $proyecto['id']; ?>)">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal de formulario -->
    <div id="modalFormulario" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="tituloModal">Nuevo Proyecto</h2>
                <span class="close" onclick="cerrarModal()">&times;</span>
            </div>
            <form id="formProyecto" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" id="accion" value="crear">
                <input type="hidden" name="id" id="proyectoId">
                <input type="hidden" name="imagen_actual" id="imagenActual">

                <div class="form-grid">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo_solucion">Tipo de Solución</label>
                        <input type="text" class="form-control" id="tipo_solucion" name="tipo_solucion" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen Principal</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                        <div class="preview-image" id="previewImagen"></div>
                    </div>

                    <div class="form-group full-width">
                        <label for="descripcion_corta">Descripción Corta</label>
                        <textarea class="form-control tinymce" id="descripcion_corta" name="descripcion_corta" required></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label for="descripcion">Descripción Completa</label>
                        <textarea class="form-control tinymce" id="descripcion" name="descripcion" required></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label for="caracteristicas">Características (una por línea)</label>
                        <textarea class="form-control" id="caracteristicas" name="caracteristicas"></textarea>
                    </div>

                    <div class="form-group full-width">
                        <div class="servicios-section">
                            <h3>Servicios Relacionados</h3>
                            <div class="servicios-grid">
                                <?php foreach ($servicios as $servicio): ?>
                                    <div class="servicio-item">
                                        <input type="checkbox" name="servicios[]" value="<?php echo $servicio['id']; ?>" 
                                               id="servicio_<?php echo $servicio['id']; ?>">
                                        <label for="servicio_<?php echo $servicio['id']; ?>">
                                            <i class="fas fa-check-circle"></i>
                                            <?php echo htmlspecialchars($servicio['nombre']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label>Imágenes Adicionales</label>
                        <input type="file" class="form-control" name="imagenes_adicionales[]" multiple accept="image/*">
                        <div id="descripcionesImagenes"></div>
                    </div>

                    <div class="form-group checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="destacado" name="destacado">
                            <label for="destacado">
                                <i class="fas fa-star"></i>
                                Destacado
                            </label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="activo" name="activo" checked>
                            <label for="activo">
                                <i class="fas fa-check-circle"></i>
                                Activo
                            </label>
                        </div>
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

<?php
// Variable para scripts adicionales
$scripts_adicionales = '
<script src="https://cdn.tiny.cloud/1/4u89qw1ptzfqell0ybjhqth1cc16ilb1y0792h3momw4lk8l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Inicializar TinyMCE
    function initTinyMCE() {
        tinymce.init({
            selector: ".tinymce",
            plugins: "advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount",
            toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
            height: 300,
            language: "es",
            branding: false,
            setup: function(editor) {
                editor.on("change", function() {
                    editor.save(); // Guarda el contenido en el textarea original
                });
            }
        });
    }

    // Función para validar el formulario antes de enviar
    function validarFormulario() {
        const form = document.getElementById("formProyecto");
        const descripcionCorta = tinymce.get("descripcion_corta").getContent();
        const descripcion = tinymce.get("descripcion").getContent();

        if (!descripcionCorta.trim()) {
            alert("Por favor, ingrese una descripción corta");
            return false;
        }

        if (!descripcion.trim()) {
            alert("Por favor, ingrese una descripción completa");
            return false;
        }

        return true;
    }

    // Función para mostrar/ocultar formulario
    function mostrarFormulario(accion, id = null) {
        const modal = document.getElementById("modalFormulario");
        const form = document.getElementById("formProyecto");
        const titulo = document.getElementById("tituloModal");
        const accionInput = document.getElementById("accion");
        const proyectoId = document.getElementById("proyectoId");

        // Configurar el formulario según la acción
        if (accion === "crear") {
            titulo.textContent = "Nuevo Proyecto";
            accionInput.value = "crear";
            form.reset();
            proyectoId.value = "";
            document.getElementById("previewImagen").innerHTML = "";
            tinymce.get("descripcion_corta").setContent("");
            tinymce.get("descripcion").setContent("");
        } else {
            titulo.textContent = "Editar Proyecto";
            accionInput.value = "actualizar";
            proyectoId.value = id;

            // Cargar datos del proyecto
            fetch(`get_proyecto.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("cliente").value = data.cliente;
                    document.getElementById("tipo_solucion").value = data.tipo_solucion;
                    tinymce.get("descripcion").setContent(data.descripcion);
                    tinymce.get("descripcion_corta").setContent(data.descripcion_corta);
                    document.getElementById("caracteristicas").value = data.caracteristicas;
                    document.getElementById("fecha").value = data.fecha;
                    document.getElementById("imagenActual").value = data.imagen;
                    document.getElementById("destacado").checked = data.destacado == 1;
                    document.getElementById("activo").checked = data.activo == 1;

                    // Mostrar imagen actual
                    if (data.imagen) {
                        document.getElementById("previewImagen").innerHTML = `
                            <img src="../${data.imagen}" alt="Imagen actual">
                        `;
                    }

                    // Marcar servicios relacionados
                    data.servicios.forEach(servicioId => {
                        const checkbox = document.getElementById(`servicio_${servicioId}`);
                        if (checkbox) checkbox.checked = true;
                    });
                });
        }

        modal.style.display = "block";
    }

    // Inicializar TinyMCE al cargar la página
    document.addEventListener("DOMContentLoaded", function() {
        initTinyMCE();
        
        // Agregar validación al formulario
        const form = document.getElementById("formProyecto");
        form.onsubmit = function(e) {
            if (!validarFormulario()) {
                e.preventDefault();
            }
        };
    });

    function cerrarModal() {
        document.getElementById("modalFormulario").style.display = "none";
    }

    function eliminarProyecto(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este proyecto?")) {
            const form = document.createElement("form");
            form.method = "POST";
            form.innerHTML = `
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id" value="${id}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Cerrar modal al hacer clic fuera
    window.onclick = function(event) {
        const modal = document.getElementById("modalFormulario");
        if (event.target == modal) {
            cerrarModal();
        }
    }

    // Preview de imagen
    document.getElementById("imagen").addEventListener("change", function(e) {
        const preview = document.getElementById("previewImagen");
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .project-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .project-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 3rem;
    }

    .project-status {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .project-status.active {
        background: #28a745;
        color: #fff;
    }

    .project-status.inactive {
        background: #dc3545;
        color: #fff;
    }

    .project-featured {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #ffc107;
        color: #000;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .project-content {
        padding: 1.5rem;
    }

    .project-content h3 {
        margin: 0 0 0.5rem 0;
        color: #2c3e50;
        font-size: 1.25rem;
    }

    .project-type {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .project-date {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .project-description {
        color: #495057;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .project-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-edit:hover {
        background: #0056b3;
    }

    .btn-delete {
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #495057;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .servicios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .servicio-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .servicio-item:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .servicio-item input[type="checkbox"] {
        display: none;
    }

    .servicio-item label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        cursor: pointer;
        margin: 0;
        font-size: 0.95rem;
        color: #495057;
    }

    .servicio-item label::before {
        content: "";
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #6c757d;
        border-radius: 4px;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    .servicio-item input[type="checkbox"]:checked + label::before {
        background-color: #007bff;
        border-color: #007bff;
        content: "✓";
        color: white;
        text-align: center;
        line-height: 16px;
        font-size: 12px;
    }

    .servicio-item i {
        color: #007bff;
        font-size: 1.1rem;
    }

    .servicios-section {
        background: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .servicios-section h3 {
        margin-bottom: 1rem;
        color: #2c3e50;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .servicios-section .form-group {
        margin-bottom: 0;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        flex: 1;
    }

    .checkbox-item:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .checkbox-item input[type="checkbox"] {
        display: none;
    }

    .checkbox-item label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        cursor: pointer;
        margin: 0;
        font-size: 0.95rem;
        color: #495057;
    }

    .checkbox-item label::before {
        content: "";
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #6c757d;
        border-radius: 4px;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    .checkbox-item input[type="checkbox"]:checked + label::before {
        background-color: #007bff;
        border-color: #007bff;
        content: "✓";
        color: white;
        text-align: center;
        line-height: 16px;
        font-size: 12px;
    }

    .checkbox-item i {
        color: #007bff;
        font-size: 1.1rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .preview-image {
        margin-top: 1rem;
    }

    .preview-image img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .projects-grid {
            grid-template-columns: 1fr;
        }

        .servicios-grid {
            grid-template-columns: 1fr;
        }

        .checkbox-group {
            flex-direction: column;
        }
    }

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
        max-width: 800px;
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

    .modal-header h2 {
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
';

// Incluir el footer
include('includes/footer.php');
?> 