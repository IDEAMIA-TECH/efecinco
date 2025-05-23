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
       

        <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1520869562399-e772f042f422?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center; background-size: cover;">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-logo-wrapper">
                        <img src="assets/images/logof5.png" alt="Logo F5" class="hero-logo">
                    </div>
                    <h1>Nuestros Servicios</h1>
                    <p>Soluciones integrales en seguridad y tecnología para tu empresa</p>
                   
                </div>
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
                                    <?php if (strtolower($servicio['nombre']) === 'cableado estructurado'): ?>
                                        <img src="assets/images/cableado.jpg" alt="Cableado Estructurado">
                                    <?php elseif (strtolower($servicio['nombre']) === 'sistemas de audio ambiental'): ?>
                                        <img src="assets/images/amniental.jpg" alt="Sistemas de Audio Ambiental">
                                    <?php elseif (strtolower($servicio['nombre']) === 'cctv' || strtolower($servicio['nombre']) === 'cámaras de seguridad'): ?>
                                        <img src="assets/images/cctv.jpg" alt="CCTV">
                                    <?php elseif (strtolower($servicio['nombre']) === 'control de acceso'): ?>
                                        <img src="assets/images/control.jpg" alt="Control de Acceso">
                                    <?php elseif (strtolower($servicio['nombre']) === 'enlaces inalámbricos'): ?>
                                        <img src="assets/images/enlaces.jpg" alt="Enlaces Inalámbricos">
                                    <?php elseif (strtolower($servicio['nombre']) === 'soporte ti' || strtolower($servicio['nombre']) === 'soporte técnico'): ?>
                                        <img src="assets/images/soporte.jpg" alt="Soporte TI">
                                    <?php elseif (strtolower($servicio['nombre']) === 'desarrollo'): ?>
                                        <img src="assets/images/desarrollo.png" alt="Desarrollo">
                                    <?php elseif (strtolower($servicio['nombre']) === 'equipos y tecnología'): ?>
                                        <img src="assets/images/equipo.png" alt="Equipos y Tecnología">
                                    <?php else: ?>
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
                                                case 'soporte ti':
                                                    echo 'fas fa-headset';
                                                    break;
                                                case 'servidores':
                                                    echo 'fas fa-server';
                                                    break;
                                                case 'backup':
                                                case 'respaldo':
                                                    echo 'fas fa-database';
                                                    break;
                                                case 'sistemas de audio ambiental':
                                                    echo 'fas fa-volume-up';
                                                    break;
                                                case 'enlaces inalámbricos':
                                                    echo 'fas fa-wifi';
                                                    break;
                                                case 'equipos y tecnología':
                                                    echo 'fas fa-laptop';
                                                    break;
                                                default:
                                                    echo 'fas fa-cogs';
                                            }
                                        ?>"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="servicio-contenido">
                                    <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                                    <p><?php echo strip_tags($servicio['descripcion']); ?></p>
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

        .hero-logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.95);
            border-radius: 50%;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0,114,255,0.25), 0 2px 8px rgba(0,180,219,0.15);
            border: 4px solid #00B4DB;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: logo-glow 2s infinite alternate;
            max-width: 320px;
            margin: 0 auto 30px auto;
        }

        .hero-logo {
            max-width: 180px;
            max-height: 180px;
            width: auto;
            height: auto;
            display: block;
            border-radius: 0;
            box-shadow: none;
            background: none;
            padding: 0;
        }

        @keyframes logo-glow {
            from {
                box-shadow: 0 8px 32px rgba(0,114,255,0.25), 0 2px 8px rgba(0,180,219,0.15);
            }
            to {
                box-shadow: 0 0 40px 10px #00B4DB, 0 2px 8px rgba(0,180,219,0.25);
            }
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
            
            font-size: 2.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .servicio-icono img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 0px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
            display: block;
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