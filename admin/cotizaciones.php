<?php
require_once('auth.php');
require_once('../includes/functions.php');
$conexion = conectarDB();

$mensaje = '';
$error = '';
$tipo_cotizacion = $_GET['tipo'] ?? 'camaras'; // Por defecto mostrar cámaras
$pagina_actual = 'cotizaciones'; // Para el header activo

// Procesar acciones
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'] ?? 0;
    $tipo = $_GET['tipo'] ?? 'camaras';

    // Determinar la tabla según el tipo
    $tabla = match($tipo) {
        'camaras' => 'cotizaciones_camaras',
        'acceso' => 'cotizaciones_acceso',
        'cableado' => 'cotizaciones_cableado',
        default => 'cotizaciones_camaras'
    };

    if ($action === 'view') {
        // Ver detalles de la cotización
        $sql = "SELECT * FROM $tabla WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $cotizacion = $stmt->get_result()->fetch_assoc();
    } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Actualizar estado de la cotización
        $estado = limpiarDatos($_POST['estado']);
        $comentarios_admin = limpiarDatos($_POST['comentarios_admin']);

        $sql = "UPDATE $tabla SET estado = ?, comentarios_admin = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $estado, $comentarios_admin, $id);

        if ($stmt->execute()) {
            $mensaje = "Cotización actualizada correctamente.";
        } else {
            $error = "Error al actualizar la cotización.";
        }
    }
}

// Obtener todas las cotizaciones según el tipo
$tabla = match($tipo_cotizacion) {
    'camaras' => 'cotizaciones_camaras',
    'acceso' => 'cotizaciones_acceso',
    'cableado' => 'cotizaciones_cableado',
    default => 'cotizaciones_camaras'
};

$sql = "SELECT * FROM $tabla ORDER BY fecha_creacion DESC";
$cotizaciones = $conexion->query($sql);

$titulo_pagina = 'Administrar Cotizaciones';
require_once('includes/header.php');
?>

<div class="main-content">
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="cotizaciones-filters">
        <h2>Cotizaciones</h2>
        <div class="filter-buttons">
            <a href="?tipo=camaras" class="btn <?php echo $tipo_cotizacion === 'camaras' ? 'btn-primary' : 'btn-secondary'; ?>">
                <i class="fas fa-camera"></i> Cámaras
            </a>
            <a href="?tipo=acceso" class="btn <?php echo $tipo_cotizacion === 'acceso' ? 'btn-primary' : 'btn-secondary'; ?>">
                <i class="fas fa-door-closed"></i> Control de Acceso
            </a>
            <a href="?tipo=cableado" class="btn <?php echo $tipo_cotizacion === 'cableado' ? 'btn-primary' : 'btn-secondary'; ?>">
                <i class="fas fa-network-wired"></i> Cableado
            </a>
        </div>
    </div>

    <?php if (isset($action) && $action === 'view' && $cotizacion): ?>
        <div class="cotizacion-details">
            <div class="details-header">
                <h2>Detalles de la Cotización</h2>
                <a href="cotizaciones.php?tipo=<?php echo $tipo_cotizacion; ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <div class="details-grid">
                <div class="details-section">
                    <h3>Información General</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($cotizacion['nombre']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($cotizacion['telefono']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($cotizacion['email']); ?></p>
                    <p><strong>Empresa:</strong> <?php echo htmlspecialchars($cotizacion['empresa'] ?? 'No especificada'); ?></p>
                    <p><strong>Referencia:</strong> <?php echo htmlspecialchars($cotizacion['referencia']); ?></p>
                    <?php if (isset($cotizacion['referencia_otro']) && $cotizacion['referencia_otro']): ?>
                        <p><strong>Otra referencia:</strong> <?php echo htmlspecialchars($cotizacion['referencia_otro']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if ($tipo_cotizacion === 'camaras'): ?>
                    <div class="details-section">
                        <h3>Requerimientos de Cámaras</h3>
                        <p><strong>Cantidad de cámaras:</strong> <?php echo htmlspecialchars($cotizacion['cantidad_camaras']); ?></p>
                        <p><strong>Tipo de cámaras:</strong> <?php echo htmlspecialchars($cotizacion['tipo_camaras']); ?></p>
                        <p><strong>Visión nocturna:</strong> <?php echo htmlspecialchars($cotizacion['vision_nocturna']); ?></p>
                        <p><strong>Visualización remota:</strong> <?php echo htmlspecialchars($cotizacion['visualizacion_remota']); ?></p>
                        <p><strong>Almacenamiento:</strong> <?php echo htmlspecialchars($cotizacion['almacenamiento']); ?></p>
                    </div>
                <?php elseif ($tipo_cotizacion === 'acceso'): ?>
                    <div class="details-section">
                        <h3>Requerimientos de Control de Acceso</h3>
                        <p><strong>Tipo de sistema:</strong> <?php echo htmlspecialchars($cotizacion['tipo_sistema']); ?></p>
                        <p><strong>Cantidad de accesos:</strong> <?php echo htmlspecialchars($cotizacion['cantidad_accesos']); ?></p>
                        <p><strong>Tipo de control:</strong> <?php echo htmlspecialchars($cotizacion['tipo_control']); ?></p>
                        <p><strong>Integración con otros sistemas:</strong> <?php echo htmlspecialchars($cotizacion['integracion_sistemas']); ?></p>
                    </div>
                <?php elseif ($tipo_cotizacion === 'cableado'): ?>
                    <div class="details-section">
                        <h3>Requerimientos de Cableado</h3>
                        <p><strong>Tipo de cableado:</strong> <?php echo htmlspecialchars($cotizacion['tipo_cableado']); ?></p>
                        <p><strong>Puntos de red:</strong> <?php echo htmlspecialchars($cotizacion['puntos_red']); ?></p>
                        <p><strong>Puntos de energía:</strong> <?php echo htmlspecialchars($cotizacion['puntos_energia']); ?></p>
                        <p><strong>Área a cubrir:</strong> <?php echo htmlspecialchars($cotizacion['area_cubrir']); ?></p>
                    </div>
                <?php endif; ?>

                <div class="details-section">
                    <h3>Ubicación del Proyecto</h3>
                    <p><strong>Dirección:</strong> <?php echo nl2br(htmlspecialchars($cotizacion['direccion'])); ?></p>
                    <p><strong>Tipo de propiedad:</strong> <?php echo htmlspecialchars($cotizacion['tipo_propiedad']); ?></p>
                    <?php if (isset($cotizacion['tipo_propiedad_otro']) && $cotizacion['tipo_propiedad_otro']): ?>
                        <p><strong>Otro tipo:</strong> <?php echo htmlspecialchars($cotizacion['tipo_propiedad_otro']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="details-section">
                    <h3>Condiciones del Sitio</h3>
                    <p><strong>Red eléctrica:</strong> <?php echo htmlspecialchars($cotizacion['red_electrica']); ?></p>
                    <p><strong>Red de internet:</strong> <?php echo htmlspecialchars($cotizacion['red_internet']); ?></p>
                    <p><strong>Infraestructura previa:</strong> <?php echo htmlspecialchars($cotizacion['infraestructura_previo']); ?></p>
                </div>

                <div class="details-section">
                    <h3>Preferencias de Instalación</h3>
                    <p><strong>Tiempo de instalación:</strong> <?php echo htmlspecialchars($cotizacion['tiempo_instalacion']); ?></p>
                    <p><strong>Horario de contacto:</strong> <?php echo htmlspecialchars($cotizacion['horario_contacto']); ?></p>
                </div>

                <?php if ($cotizacion['comentarios']): ?>
                    <div class="details-section">
                        <h3>Comentarios del Cliente</h3>
                        <p><?php echo nl2br(htmlspecialchars($cotizacion['comentarios'])); ?></p>
                    </div>
                <?php endif; ?>

                <div class="details-section">
                    <h3>Administración</h3>
                    <form method="POST" action="?action=edit&id=<?php echo $cotizacion['id']; ?>&tipo=<?php echo $tipo_cotizacion; ?>">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" required>
                                <option value="pendiente" <?php echo $cotizacion['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="en_proceso" <?php echo $cotizacion['estado'] === 'en_proceso' ? 'selected' : ''; ?>>En Proceso</option>
                                <option value="completado" <?php echo $cotizacion['estado'] === 'completado' ? 'selected' : ''; ?>>Completado</option>
                                <option value="cancelado" <?php echo $cotizacion['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comentarios_admin">Comentarios del Administrador</label>
                            <textarea name="comentarios_admin" id="comentarios_admin" rows="4"><?php echo htmlspecialchars($cotizacion['comentarios_admin'] ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="cotizaciones-list">
            <div class="cotizaciones-table">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($cotizacion = $cotizaciones->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($cotizacion['fecha_creacion'])); ?></td>
                            <td><?php echo htmlspecialchars($cotizacion['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($cotizacion['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($cotizacion['email']); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo $cotizacion['estado']; ?>">
                                    <?php echo ucfirst($cotizacion['estado']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="?action=view&id=<?php echo $cotizacion['id']; ?>&tipo=<?php echo $tipo_cotizacion; ?>" class="action-btn view-btn">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="?action=edit&id=<?php echo $cotizacion['id']; ?>&tipo=<?php echo $tipo_cotizacion; ?>" class="action-btn edit-btn">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .cotizaciones-filters {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        background: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .filter-buttons {
        display: flex;
        gap: 1rem;
        width: 100%;
        justify-content: center;
    }

    .filter-buttons .btn {
        flex: 1;
        max-width: 200px;
        min-width: 150px;
        text-align: center;
        justify-content: center;
        white-space: nowrap;
        padding: 0.75rem 1rem;
    }

    .filter-buttons .btn i {
        margin-right: 0.5rem;
    }

    .cotizaciones-list,
    .cotizacion-details {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    .details-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .details-header h2 {
        color: #2c3e50;
        margin: 0;
        font-size: 1.8rem;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .details-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .details-section h3 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        border-bottom: 2px solid #00B4DB;
        padding-bottom: 0.5rem;
    }

    .details-section p {
        margin: 0.5rem 0;
        color: #495057;
        line-height: 1.5;
    }

    .details-section p strong {
        color: #2c3e50;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #495057;
        font-weight: 500;
    }

    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #00B4DB;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0,180,219,0.2);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .btn i {
        margin-right: 0.5rem;
    }

    .btn-primary {
        background-color: #00B4DB;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0099b8;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
    }

    .alert {
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 4px;
        font-weight: 500;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .cotizaciones-table {
        overflow-x: auto;
        margin-top: 1.5rem;
    }

    .cotizaciones-table table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .cotizaciones-table th,
    .cotizaciones-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }

    .cotizaciones-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }

    .cotizaciones-table tr:hover {
        background-color: #f8f9fa;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        text-align: center;
        display: inline-block;
    }

    .status-pendiente {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-en_proceso {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-completado {
        background-color: #d4edda;
        color: #155724;
    }

    .status-cancelado {
        background-color: #f8d7da;
        color: #721c24;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin: 0 0.25rem;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .view-btn {
        background-color: #17a2b8;
    }

    .edit-btn {
        background-color: #28a745;
    }

    .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .cotizaciones-filters {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-buttons .btn {
            max-width: none;
            width: 100%;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .details-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .cotizaciones-table {
            font-size: 0.875rem;
        }

        .cotizaciones-table th,
        .cotizaciones-table td {
            padding: 0.75rem;
        }
    }
</style>
</body>
</html> 