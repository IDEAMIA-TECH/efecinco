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
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $icono = $_POST['icono'] ?? '';
                $orden = $_POST['orden'] ?? 0;
                
                if (!empty($nombre)) {
                    $sql = "INSERT INTO servicios (nombre, descripcion, icono, orden) VALUES (?, ?, ?, ?)";
                    $stmt = consultaSegura($conexion, $sql, [$nombre, $descripcion, $icono, $orden]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Servicio creado exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al crear el servicio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'update':
                $id = $_POST['id'] ?? 0;
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $icono = $_POST['icono'] ?? '';
                $orden = $_POST['orden'] ?? 0;
                $activo = isset($_POST['activo']) ? 1 : 0;
                
                if ($id > 0 && !empty($nombre)) {
                    $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, icono = ?, orden = ?, activo = ? WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$nombre, $descripcion, $icono, $orden, $activo, $id]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Servicio actualizado exitosamente';
                        $tipo_mensaje = 'success';
                    } else {
                        $mensaje = 'Error al actualizar el servicio';
                        $tipo_mensaje = 'danger';
                    }
                }
                break;
                
            case 'delete':
                $id = $_POST['id'] ?? 0;
                if ($id > 0) {
                    $sql = "DELETE FROM servicios WHERE id = ?";
                    $stmt = consultaSegura($conexion, $sql, [$id]);
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = 'Servicio eliminado exitosamente';
                        $tipo_mensaje = 'success';
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios - Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main class="admin-content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Gestión de Servicios</h2>
                    <button class="btn btn-success" onclick="mostrarFormulario('nuevo')">
                        <i class="fas fa-plus"></i> Nuevo Servicio
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

            <!-- Formulario de creación/edición -->
            <div id="formularioServicio" class="card" style="display: none;">
                <div class="card-header">
                    <h3 id="tituloFormulario">Nuevo Servicio</h3>
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
                        <textarea id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="icono">Icono (Font Awesome)</label>
                        <input type="text" id="icono" name="icono" placeholder="fa-icon-name">
                    </div>
                    
                    <div class="form-group">
                        <label for="orden">Orden</label>
                        <input type="number" id="orden" name="orden" value="0">
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
            const formulario = document.getElementById('formularioServicio');
            const titulo = document.getElementById('tituloFormulario');
            const formAction = document.getElementById('formAction');
            const servicioId = document.getElementById('servicioId');
            
            if (accion === 'nuevo') {
                titulo.textContent = 'Nuevo Servicio';
                formAction.value = 'create';
                servicioId.value = '';
                document.getElementById('formServicio').reset();
                document.getElementById('activo').checked = true;
            } else {
                titulo.textContent = 'Editar Servicio';
                formAction.value = 'update';
                servicioId.value = id;
                
                // Obtener los datos del servicio
                fetch(`get_servicio.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('nombre').value = data.nombre;
                            document.getElementById('descripcion').value = data.descripcion;
                            document.getElementById('icono').value = data.icono;
                            document.getElementById('orden').value = data.orden;
                            document.getElementById('activo').checked = data.activo == 1;
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar los datos:', error);
                        alert('Error al cargar los datos del servicio');
                    });
            }
            
            formulario.style.display = 'block';
            window.scrollTo({
                top: formulario.offsetTop - 20,
                behavior: 'smooth'
            });
        }
        
        function ocultarFormulario() {
            document.getElementById('formularioServicio').style.display = 'none';
        }

        // Cerrar automáticamente los mensajes de alerta después de 5 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.auto-dismiss');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>
</html> 