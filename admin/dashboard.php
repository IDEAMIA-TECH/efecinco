<?php
require_once('auth.php');
$conexion = conectarDB();

// Obtener estadísticas
$stats = [
    'servicios' => 0,
    'proyectos' => 0,
    'testimonios' => 0,
    'certificaciones' => 0
];

// Contar servicios
$sql = "SELECT COUNT(*) as total FROM servicios WHERE activo = 1";
$resultado = $conexion->query($sql);
$stats['servicios'] = $resultado->fetch_assoc()['total'];

// Contar proyectos
$sql = "SELECT COUNT(*) as total FROM proyectos WHERE activo = 1";
$resultado = $conexion->query($sql);
$stats['proyectos'] = $resultado->fetch_assoc()['total'];

// Contar testimonios
$sql = "SELECT COUNT(*) as total FROM testimonios WHERE activo = 1";
$resultado = $conexion->query($sql);
$stats['testimonios'] = $resultado->fetch_assoc()['total'];

// Contar certificaciones
$sql = "SELECT COUNT(*) as total FROM certificaciones WHERE activo = 1";
$resultado = $conexion->query($sql);
$stats['certificaciones'] = $resultado->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <h1>Panel de Administración</h1>
            <nav class="admin-nav">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <a href="servicios.php"><i class="fas fa-cogs"></i> Servicios</a>
                <a href="proyectos.php"><i class="fas fa-project-diagram"></i> Proyectos</a>
                <a href="testimonios.php"><i class="fas fa-comments"></i> Testimonios</a>
                <a href="certificaciones.php"><i class="fas fa-certificate"></i> Certificaciones</a>
                <a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <main class="admin-content">
        <div class="container">
            <div class="welcome-message">
                <h2>Bienvenido, <?php echo htmlspecialchars(getCurrentAdminName()); ?></h2>
                <p>Último acceso: <?php echo date('d/m/Y H:i'); ?></p>
            </div>

            <div class="stats-grid">
                <div class="card">
                    <h3>Servicios</h3>
                    <p class="stat-number"><?php echo $stats['servicios']; ?></p>
                    <a href="servicios.php" class="btn btn-primary">Gestionar</a>
                </div>
                <div class="card">
                    <h3>Proyectos</h3>
                    <p class="stat-number"><?php echo $stats['proyectos']; ?></p>
                    <a href="proyectos.php" class="btn btn-primary">Gestionar</a>
                </div>
                <div class="card">
                    <h3>Testimonios</h3>
                    <p class="stat-number"><?php echo $stats['testimonios']; ?></p>
                    <a href="testimonios.php" class="btn btn-primary">Gestionar</a>
                </div>
                <div class="card">
                    <h3>Certificaciones</h3>
                    <p class="stat-number"><?php echo $stats['certificaciones']; ?></p>
                    <a href="certificaciones.php" class="btn btn-primary">Gestionar</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Acciones Rápidas</h3>
                </div>
                <div class="quick-actions">
                    <a href="servicios.php?action=new" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Servicio
                    </a>
                    <a href="proyectos.php?action=new" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Proyecto
                    </a>
                    <a href="testimonios.php?action=new" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Testimonio
                    </a>
                    <a href="certificaciones.php?action=new" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nueva Certificación
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html> 