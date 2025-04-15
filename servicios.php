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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
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
                                        switch($servicio['id']) {
                                            case 1:
                                                echo 'fas fa-network-wired';
                                                break;
                                            case 2:
                                                echo 'fas fa-video';
                                                break;
                                            case 3:
                                                echo 'fas fa-door-closed';
                                                break;
                                            case 4:
                                                echo 'fas fa-wifi';
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
        body {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            background: #f4f8fb;
            color: #222;
        }
        .hero {
            position: relative;
            background: linear-gradient(120deg, #00B4DB 0%, #0072ff 100%);
            color: white;
            text-align: center;
            padding: 120px 0 80px 0;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 100%);
            z-index: 1;
        }
        .hero .container, .hero-icon {
            position: relative;
            z-index: 2;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0,180,219,0.2);
            font-weight: 700;
            letter-spacing: 2px;
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0,180,219,0.15);
            font-weight: 400;
        }
        .hero-icon {
            font-size: 4rem;
            margin-top: 20px;
            color: rgba(0,180,219,0.3);
            transition: all 0.3s ease;
        }
        .hero:hover .hero-icon {
            color: rgba(0,180,219,0.5);
            transform: scale(1.1);
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
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,180,219,0.07);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s;
            text-align: center;
            border: 1px solid #e3f0fa;
        }
        .servicio-icono {
            background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
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
            background: linear-gradient(45deg, #00B4DB, #0072ff);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .servicio-icono i {
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }
        .servicio-card:hover .servicio-icono::before {
            opacity: 0.15;
        }
        .servicio-card:hover .servicio-icono i {
            transform: scale(1.2);
        }
        .servicio-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px rgba(0,114,255,0.13);
        }
        .servicio-contenido {
            padding: 20px;
        }
        .servicio-contenido h3 {
            margin-bottom: 15px;
            color: #0072ff;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .servicio-contenido p {
            color: #444;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .beneficios {
            background: linear-gradient(120deg, #f4f8fb 60%, #e3f0fa 100%);
            padding: 80px 0;
        }
        .beneficios h2 {
            text-align: center;
            margin-bottom: 50px;
            color: #0072ff;
            font-weight: 700;
        }
        .beneficios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .beneficio-item {
            text-align: center;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,180,219,0.08);
        }
        .beneficio-icono {
            font-size: 2.5rem;
            color: #00B4DB;
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
            background: linear-gradient(90deg, #00B4DB, #0072ff);
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        .beneficio-item:hover .beneficio-icono {
            color: #0072ff;
            transform: translateY(-5px);
        }
        .beneficio-item:hover .beneficio-icono::after {
            width: 60px;
        }
        .beneficio-item h3 {
            margin-bottom: 15px;
            color: #0072ff;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .beneficio-item p {
            color: #444;
            line-height: 1.6;
        }
        .cta {
            padding: 60px 0;
            text-align: center;
        }
        .cta h2 {
            margin-bottom: 1rem;
            color: #0072ff;
            font-weight: 700;
        }
        .cta p {
            margin-bottom: 2rem;
            color: #666;
        }
        .btn {
            padding: 15px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
            box-shadow: 0 4px 16px rgba(0,180,219,0.08);
            border: none;
            outline: none;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
            color: #fff;
        }
        .btn-primary {
            background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,180,219,0.15);
        }
        .btn-primary:hover, .btn:hover {
            background: linear-gradient(90deg, #0072ff 0%, #00B4DB 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 6px 18px rgba(0,114,255,0.18);
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