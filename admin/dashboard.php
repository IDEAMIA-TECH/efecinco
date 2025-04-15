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
<body class="modern-admin">
    <div class="admin-wrapper">
        <header class="admin-header">
            <div class="header-logo">
                <img src="../assets/images/logo.png" alt="Efecinco Logo" class="logo">
                <h2>Efecinco</h2>
            </div>
            <nav class="admin-nav">
                <a href="dashboard.php" class="active">
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
                <a href="?logout=1" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </header>

        <main class="admin-main">
            <div class="main-content">
                <div class="welcome-card">
                    <div class="welcome-text">
                        <h2>Bienvenido de nuevo, <?php echo htmlspecialchars(getCurrentAdminName()); ?></h2>
                        <p>Último acceso: <?php echo date('d/m/Y H:i'); ?></p>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Servicios</h3>
                            <p class="stat-number"><?php echo $stats['servicios']; ?></p>
                        </div>
                        <a href="servicios.php" class="stat-link">Ver detalles <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Proyectos</h3>
                            <p class="stat-number"><?php echo $stats['proyectos']; ?></p>
                        </div>
                        <a href="proyectos.php" class="stat-link">Ver detalles <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Testimonios</h3>
                            <p class="stat-number"><?php echo $stats['testimonios']; ?></p>
                        </div>
                        <a href="testimonios.php" class="stat-link">Ver detalles <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Certificaciones</h3>
                            <p class="stat-number"><?php echo $stats['certificaciones']; ?></p>
                        </div>
                        <a href="certificaciones.php" class="stat-link">Ver detalles <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="quick-actions-section">
                    <h2>Acciones Rápidas</h2>
                    <div class="quick-actions-grid">
                        <a href="servicios.php?action=new" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <h3>Nuevo Servicio</h3>
                            <p>Agregar un nuevo servicio al catálogo</p>
                        </a>
                        <a href="proyectos.php?action=new" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <h3>Nuevo Proyecto</h3>
                            <p>Registrar un nuevo proyecto realizado</p>
                        </a>
                        <a href="testimonios.php?action=new" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <h3>Nuevo Testimonio</h3>
                            <p>Añadir un nuevo testimonio de cliente</p>
                        </a>
                        <a href="certificaciones.php?action=new" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <h3>Nueva Certificación</h3>
                            <p>Agregar una nueva certificación</p>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .modern-admin {
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #2c3e50;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }

        .admin-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-header {
            background: #fff;
            padding: 0.5rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-logo .logo {
            width: 40px;
            height: auto;
        }

        .header-logo h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.2rem;
        }

        .admin-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: #f8f9fa;
            color: #007bff;
        }

        .admin-nav a i {
            font-size: 1rem;
        }

        .admin-nav a span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .logout-btn {
            color: #dc3545;
        }

        .logout-btn:hover {
            background: #f8f9fa;
            color: #c82333;
        }

        .admin-main {
            margin-top: 70px;
            padding: 2rem;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .welcome-card {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .welcome-card h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.8rem;
        }

        .welcome-card p {
            margin: 0;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .stat-icon {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 1rem;
        }

        .stat-info h3 {
            margin: 0;
            color: #6c757d;
            font-size: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0.5rem 0;
        }

        .stat-link {
            color: #007bff;
            text-decoration: none;
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .quick-actions-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .quick-actions-section h2 {
            margin: 0 0 1.5rem 0;
            color: #2c3e50;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            color: #2c3e50;
            text-align: center;
            transition: all 0.3s ease;
        }

        .action-card:hover {
            background: #007bff;
            color: white;
            transform: translateY(-5px);
        }

        .action-card:hover .action-icon {
            color: white;
        }

        .action-icon {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 1rem;
        }

        .action-card h3 {
            margin: 0 0 0.5rem 0;
            font-size: 1.1rem;
        }

        .action-card p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media (max-width: 1024px) {
            .admin-nav {
                gap: 1rem;
            }

            .admin-nav a {
                padding: 0.5rem;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 0.5rem 1rem;
            }

            .header-logo h2 {
                display: none;
            }

            .admin-nav a span {
                display: none;
            }

            .admin-nav a i {
                font-size: 1.2rem;
            }

            .admin-nav {
                gap: 0.5rem;
            }
        }
    </style>

    <script src="../assets/js/admin.js"></script>
</body>
</html> 