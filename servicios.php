<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener servicios activos
$sql = "SELECT * FROM servicios WHERE activo = 1 ORDER BY orden";
$resultado = $conexion->query($sql);
$servicios = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Efecinco</title>
    <meta name="description" content="Conoce nuestros servicios en seguridad y tecnología: cableado estructurado, CCTV, control de acceso, y más.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Nuestros Servicios</h1>
                <p>Soluciones integrales en seguridad y tecnología para tu empresa</p>
            </div>
            <div class="hero-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
        </section>

        <section class="servicios">
            <div class="container">
                <?php if (empty($servicios)): ?>
                    <div class="alert alert-info">
                        <p>Próximamente estaremos compartiendo nuestros servicios.</p>
                    </div>
                <?php else: ?>
                    <div class="servicios-grid">
                        <?php foreach ($servicios as $servicio): ?>
                            <div class="servicio-card">
                                <div class="servicio-icono">
                                    <i class="<?php 
                                        switch(strtolower($servicio['nombre'])) {
                                            case 'cableado estructurado':
                                                echo 'fas fa-network-wired';
                                                break;
                                            case 'cctv':
                                            case 'cámaras de seguridad':
                                                echo 'fas fa-video';
                                                break;
                                            case 'control de acceso':
                                                echo 'fas fa-door-closed';
                                                break;
                                            case 'redes inalámbricas':
                                            case 'wifi':
                                                echo 'fas fa-wifi';
                                                break;
                                            case 'telefonía ip':
                                                echo 'fas fa-phone';
                                                break;
                                            case 'soporte técnico':
                                                echo 'fas fa-headset';
                                                break;
                                            case 'servidores':
                                                echo 'fas fa-server';
                                                break;
                                            case 'backup':
                                            case 'respaldo':
                                                echo 'fas fa-database';
                                                break;
                                            default:
                                                echo 'fas fa-cogs';
                                        }
                                    ?>"></i>
                                </div>
                                <div class="servicio-contenido">
                                    <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                                    <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="beneficios">
            <div class="container">
                <h2>Beneficios de Nuestros Servicios</h2>
                <div class="beneficios-grid">
                    <div class="beneficio-item">
                        <div class="beneficio-icono">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Seguridad Garantizada</h3>
                        <p>Soluciones de seguridad robustas y confiables para proteger tus activos.</p>
                    </div>
                    <div class="beneficio-item">
                        <div class="beneficio-icono">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Disponibilidad 24/7</h3>
                        <p>Soporte técnico y monitoreo continuo para garantizar el funcionamiento.</p>
                    </div>
                    <div class="beneficio-item">
                        <div class="beneficio-icono">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3>Mantenimiento Preventivo</h3>
                        <p>Programas de mantenimiento para optimizar el rendimiento de los sistemas.</p>
                    </div>
                    <div class="beneficio-item">
                        <div class="beneficio-icono">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3>Certificaciones</h3>
                        <p>Personal certificado y equipos de última generación.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>¿Necesitas una solución personalizada?</h2>
                <p>Contáctanos para una asesoría gratuita y sin compromiso</p>
                <a href="contacto.php" class="btn btn-primary">Solicitar Asesoría</a>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <style>
        .hero {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 0;
            overflow: hidden;
        }

        .hero-icon {
            font-size: 4rem;
            margin-top: 20px;
            color: rgba(52, 152, 219, 0.3);
            transition: all 0.3s ease;
        }

        .hero:hover .hero-icon {
            color: rgba(52, 152, 219, 0.5);
            transform: scale(1.1);
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .servicios {
            padding: 80px 0;
        }

        .servicios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .servicio-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .servicio-icono {
            background: #2c3e50;
            color: #fff;
            padding: 30px;
            font-size: 2.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .servicio-icono::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #3498db, #2ecc71);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .servicio-icono i {
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .servicio-card:hover .servicio-icono::before {
            opacity: 1;
        }

        .servicio-card:hover .servicio-icono i {
            transform: scale(1.2);
        }

        .servicio-card:hover {
            transform: translateY(-5px);
        }

        .servicio-contenido {
            padding: 20px;
        }

        .servicio-contenido h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .servicio-contenido p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .beneficios {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .beneficios h2 {
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .beneficios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .beneficio-item {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .beneficio-icono {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .beneficio-icono::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #3498db, #2ecc71);
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .beneficio-item:hover .beneficio-icono {
            color: #3498db;
            transform: translateY(-5px);
        }

        .beneficio-item:hover .beneficio-icono::after {
            width: 60px;
        }

        .beneficio-item h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .beneficio-item p {
            color: #666;
            line-height: 1.6;
        }

        .cta {
            padding: 60px 0;
            text-align: center;
        }

        .cta h2 {
            margin-bottom: 1rem;
        }

        .cta p {
            margin-bottom: 2rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .servicios-grid,
            .beneficios-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 