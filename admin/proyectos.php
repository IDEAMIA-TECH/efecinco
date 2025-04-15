<?php
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

    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Tipo de Solución</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proyectos as $proyecto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($proyecto['cliente']); ?></td>
                    <td><?php echo htmlspecialchars($proyecto['tipo_solucion']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($proyecto['fecha'])); ?></td>
                    <td>
                        <?php if ($proyecto['activo']): ?>
                            <span class="badge badge-success">Activo</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-outline" onclick="mostrarFormulario('editar', <?php echo $proyecto['id']; ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="eliminarProyecto(<?php echo $proyecto['id']; ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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

                <div class="form-group">
                    <label for="cliente">Cliente</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" required>
                </div>

                <div class="form-group">
                    <label for="tipo_solucion">Tipo de Solución</label>
                    <input type="text" class="form-control" id="tipo_solucion" name="tipo_solucion" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                </div>

                <div class="form-group">
                    <label for="descripcion_corta">Descripción Corta</label>
                    <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" required></textarea>
                </div>

                <div class="form-group">
                    <label for="caracteristicas">Características (una por línea)</label>
                    <textarea class="form-control" id="caracteristicas" name="caracteristicas"></textarea>
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

                <div class="form-group">
                    <label>Servicios Relacionados</label>
                    <div class="servicios-grid">
                        <?php foreach ($servicios as $servicio): ?>
                            <div class="servicio-item">
                                <input type="checkbox" name="servicios[]" value="<?php echo $servicio['id']; ?>" 
                                       id="servicio_<?php echo $servicio['id']; ?>">
                                <label for="servicio_<?php echo $servicio['id']; ?>">
                                    <?php echo htmlspecialchars($servicio['nombre']); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Imágenes Adicionales</label>
                    <input type="file" class="form-control" name="imagenes_adicionales[]" multiple accept="image/*">
                    <div id="descripcionesImagenes"></div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="destacado" name="destacado">
                    <label for="destacado">Destacado</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="activo" name="activo" checked>
                    <label for="activo">Activo</label>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-outline" onclick="cerrarModal()">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<?php
// Variable para scripts adicionales
$scripts_adicionales = '
<script>
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
                    document.getElementById("descripcion").value = data.descripcion;
                    document.getElementById("descripcion_corta").value = data.descripcion_corta;
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
';

// Incluir el footer
include('includes/footer.php');
?> 