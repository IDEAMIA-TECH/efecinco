<?php
require_once('auth.php');
require_once('../includes/functions.php');
$conexion = conectarDB();

$mensaje = '';
$error = '';

// Procesar acciones
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'] ?? 0;

    if ($action === 'view') {
        // Ver detalles de la cotización
        $sql = "SELECT * FROM cotizaciones_camaras WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $cotizacion = $stmt->get_result()->fetch_assoc();
    } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Actualizar estado de la cotización
        $estado = limpiarDatos($_POST['estado']);
        $comentarios_admin = limpiarDatos($_POST['comentarios_admin']);

        $sql = "UPDATE cotizaciones_camaras SET estado = ?, comentarios_admin = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $estado, $comentarios_admin, $id);

        if ($stmt->execute()) {
            $mensaje = "Cotización actualizada correctamente.";
        } else {
            $error = "Error al actualizar la cotización.";
        }
    }
}

// Obtener todas las cotizaciones
$sql = "SELECT * FROM cotizaciones_camaras ORDER BY fecha_creacion DESC";
$cotizaciones = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cotizaciones - Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="modern-admin">
    <div class="admin-wrapper">
        <header class="admin-header">
            <div class="header-logo">
                <img src="../assets/images/logof5.png" alt="Efecinco Logo" class="logo">
                <h2>Efecinco</h2>
            </div>
            <nav class="admin-nav">
                <a href="dashboard.php">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="servicios.php">
                    <i class="fas fa-cogs"></i>
                    <span>Servicios</span>
                </a>
                <a href="proyectos.php">
                    <i class="fas fa-project-diagram"></i>
                    <span>Proyectos</span>
                </a>
                <a href="testimonios.php">
                    <i class="fas fa-comments"></i>
                    <span>Testimonios</span>
                </a>
                <a href="certificaciones.php">
                    <i class="fas fa-certificate"></i>
                    <span>Certificaciones</span>
                </a>
                <a href="cotizaciones.php" class="active">
                    <i class="fas fa-camera"></i>
                    <span>Cotizaciones</span>
                </a>
                <a href="?logout=1" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </header>

        <main class="admin-main">
            <div class="main-content">
                <?php if ($mensaje): ?>
                    <div class="alert alert-success"><?php echo $mensaje; ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (isset($action) && $action === 'view' && $cotizacion): ?>
                    <div class="cotizacion-details">
                        <div class="details-header">
                            <h2>Detalles de la Cotización</h2>
                            <a href="cotizaciones.php" class="btn btn-secondary">
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
                                <?php if ($cotizacion['referencia_otro']): ?>
                                    <p><strong>Otra referencia:</strong> <?php echo htmlspecialchars($cotizacion['referencia_otro']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="details-section">
                                <h3>Ubicación del Proyecto</h3>
                                <p><strong>Dirección:</strong> <?php echo nl2br(htmlspecialchars($cotizacion['direccion'])); ?></p>
                                <p><strong>Tipo de propiedad:</strong> <?php echo htmlspecialchars($cotizacion['tipo_propiedad']); ?></p>
                                <?php if ($cotizacion['tipo_propiedad_otro']): ?>
                                    <p><strong>Otro tipo:</strong> <?php echo htmlspecialchars($cotizacion['tipo_propiedad_otro']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="details-section">
                                <h3>Requerimientos Técnicos</h3>
                                <p><strong>Cantidad de cámaras:</strong> <?php echo htmlspecialchars($cotizacion['cantidad_camaras']); ?></p>
                                <p><strong>Tipo de cámaras:</strong> <?php echo htmlspecialchars($cotizacion['tipo_camaras']); ?></p>
                                <p><strong>Visión nocturna:</strong> <?php echo htmlspecialchars($cotizacion['vision_nocturna']); ?></p>
                                <p><strong>Visualización remota:</strong> <?php echo htmlspecialchars($cotizacion['visualizacion_remota']); ?></p>
                                <p><strong>Almacenamiento:</strong> <?php echo htmlspecialchars($cotizacion['almacenamiento']); ?></p>
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
                                <form method="POST" action="?action=edit&id=<?php echo $cotizacion['id']; ?>">
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
                        <h2>Cotizaciones de Cámaras</h2>
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
                                            <a href="?action=view&id=<?php echo $cotizacion['id']; ?>" class="action-btn view-btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?action=edit&id=<?php echo $cotizacion['id']; ?>" class="action-btn edit-btn">
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
        </main>
    </div>

    <style>
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
            .details-grid {
                grid-template-columns: 1fr;
            }

            .details-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .btn {
                width: 100%;
                justify-content: center;
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