<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina ?? 'Panel de Administración'; ?> - Efecinco</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            width: 120px;
            height: auto;
            padding: 10px 0;
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
</head>
<body class="modern-admin">
    <div class="admin-wrapper">
        <header class="admin-header">
            <div class="header-logo">
                <img src="../assets/images/logof5.png" alt="Efecinco Logo" class="logo">
                <h2>Efecinco</h2>
            </div>
            <nav class="admin-nav">
                <a href="dashboard.php" <?php echo $pagina_actual === 'dashboard' ? 'class="active"' : ''; ?>>
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="servicios.php" <?php echo $pagina_actual === 'servicios' ? 'class="active"' : ''; ?>>
                    <i class="fas fa-cogs"></i>
                    <span>Servicios</span>
                </a>
                <a href="proyectos.php" <?php echo $pagina_actual === 'proyectos' ? 'class="active"' : ''; ?>>
                    <i class="fas fa-project-diagram"></i>
                    <span>Proyectos</span>
                </a>
                <a href="testimonios.php" <?php echo $pagina_actual === 'testimonios' ? 'class="active"' : ''; ?>>
                    <i class="fas fa-comments"></i>
                    <span>Testimonios</span>
                </a>
                <a href="certificaciones.php" <?php echo $pagina_actual === 'certificaciones' ? 'class="active"' : ''; ?>>
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
 