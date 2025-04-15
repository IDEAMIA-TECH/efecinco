<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener información de la empresa
$sql = "SELECT * FROM empresa WHERE id = 1";
$resultado = $conexion->query($sql);
$empresa = $resultado->fetch_assoc();

// Obtener clientes destacados
$sql = "SELECT * FROM clientes WHERE destacado = 1 ORDER BY nombre";
$resultado = $conexion->query($sql);
$clientes = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efecinco - Soluciones en Seguridad y Tecnología</title>
    <meta name="description" content="Efecinco ofrece soluciones integrales en seguridad y tecnología para empresas. Expertos en CCTV, control de acceso y más.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Soluciones en Seguridad y Tecnología</h1>
                    <p>Expertos en implementación de sistemas de seguridad y tecnología para tu empresa</p>
                    <div class="cta-buttons">
                        <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
                        <a href="contacto.php" class="btn btn-secondary">Solicita una cotización</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.pexels.com/photos/1181696/pexels-photo-1181696.jpeg?auto=compress&w=600&q=80" alt="IT Professional">
                </div>
            </div>
        </section>

        <section class="sobre-nosotros">
            <div class="container">
                <div class="texto">
                    <h2>Somos F5</h2>
                    <p>Una empresa especialista en soluciones tecnológicas para tu hogar o empresa.</p>
                    <p>Llevamos más de 15 años trabajando con marcas reconocidas en el mercado que dan garantía a cada instalación que realizamos.</p>
                    <p>Contamos con expertos consultores e instaladores que acompañan paso a paso a cada uno de nuestros clientes o proyectos; ayudando siempre, a que cada instalación tenga siempre el mejor resultado.</p>
                </div>
                <div class="caracteristicas">
                    <div class="caracteristica-item">
                        <i class="fas fa-flag"></i>
                        <h3>Una empresa 100% mexicana</h3>
                        <p>Nos enfocamos a dar siempre los mejores resultados, con soluciones que generen la seguridad que necesitas.</p>
                    </div>
                    <div class="caracteristica-item">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Confianza y Seguridad</h3>
                        <p>Buscamos que siempre te sientas seguro de vivir o trabajar con instalaciones eficientes con profesionalismo.</p>
                    </div>
                    <div class="caracteristica-item">
                        <i class="fas fa-award"></i>
                        <h3>Experiencia que nos respalda</h3>
                        <p>15 años de experiencia en el mercado nos respaldan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mision-vision">
            <div class="container">
                <div class="grid-2-columns">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Misión Efecinco">
                        <h3>Misión</h3>
                        <p><?php echo nl2br(htmlspecialchars($empresa['mision'] ?? '')); ?></p>
                    </div>
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1533749871411-5e21e14bcc7d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" alt="Visión Efecinco">
                        <h3>Visión</h3>
                        <p><?php echo nl2br(htmlspecialchars($empresa['vision'] ?? '')); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="services-section">
            <div class="services-title">Nuestros Servicios</div>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-network-wired"></i>
                    <h3>Cableado Estructurado</h3>
                    <p>Soluciones de red profesional para tu empresa</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-video"></i>
                    <h3>CCTV</h3>
                    <p>Sistemas de videovigilancia de última generación</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-lock"></i>
                    <h3>Control de Acceso</h3>
                    <p>Gestión segura de accesos a tus instalaciones</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-bell"></i>
                    <h3>Sistemas de Alarma</h3>
                    <p>Protección integral para tu hogar o negocio</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-robot"></i>
                    <h3>Automatización</h3>
                    <p>Soluciones inteligentes para tu espacio</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-volume-up"></i>
                    <h3>Sistemas de Audio</h3>
                    <p>Experiencia sonora profesional</p>
                </div>
            </div>
        </section>

        <section class="proyectos-destacados">
            <div class="container">
                <h2>Proyectos Destacados</h2>
                <div class="proyectos-grid">
                    <?php
                    $sql = "SELECT * FROM proyectos WHERE activo = 1 AND destacado = 1 ORDER BY fecha_creacion DESC LIMIT 3";
                    $stmt = consultaSegura($conexion, $sql, []);
                    if ($stmt) {
                        $result = $stmt->get_result();
                        $proyectos = $result->fetch_all(MYSQLI_ASSOC);
                        if (empty($proyectos)) {
                            echo '<div class="alert alert-info">No hay proyectos destacados disponibles</div>';
                        } else {
                            foreach ($proyectos as $proyecto):
                    ?>
                    <div class="proyecto-card">
                        <?php if ($proyecto['imagen']): ?>
                            <img src="<?php echo htmlspecialchars($proyecto['imagen']); ?>" alt="<?php echo htmlspecialchars($proyecto['cliente']); ?>" class="proyecto-imagen">
                        <?php else: ?>
                            <div class="proyecto-imagen default">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                        <div class="proyecto-info">
                            <h3><?php echo htmlspecialchars($proyecto['cliente']); ?></h3>
                            <p class="tipo-solucion"><?php echo htmlspecialchars($proyecto['tipo_solucion']); ?></p>
                            <p class="descripcion-corta"><?php echo htmlspecialchars($proyecto['descripcion_corta']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; } } else { echo '<div class="alert alert-danger">Error al ejecutar la consulta</div>'; } ?>
                </div>
            </div>
        </section>

        <section class="testimonios">
            <div class="container">
                <h2>Lo que dicen nuestros clientes</h2>
                <div class="testimonios-carousel">
                    <?php
                    $sql = "SELECT * FROM testimonios WHERE activo = 1 AND destacado = 1 ORDER BY fecha_creacion DESC LIMIT 5";
                    $stmt = consultaSegura($conexion, $sql, []);
                    if ($stmt) {
                        $result = $stmt->get_result();
                        $testimonios = $result->fetch_all(MYSQLI_ASSOC);
                        if (empty($testimonios)) {
                            echo '<div class="alert alert-info">No hay testimonios destacados disponibles</div>';
                        } else {
                            foreach ($testimonios as $testimonio):
                    ?>
                    <div class="testimonio-card">
                        <div class="testimonio-content">
                            <div class="testimonio-text">
                                <i class="fas fa-quote-left"></i>
                                <div class="testimonio-contenido">
                                    <?php echo $testimonio['testimonio']; ?>
                                </div>
                            </div>
                            <div class="testimonio-author">
                                <?php if ($testimonio['logo']): ?>
                                    <img src="<?php echo str_replace('../', '', $testimonio['logo']); ?>" alt="<?php echo htmlspecialchars($testimonio['empresa']); ?>" class="author-logo">
                                <?php else: ?>
                                    <div class="author-logo default">
                                        <i class="fas fa-building"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="author-info">
                                    <h4><?php echo htmlspecialchars($testimonio['cliente']); ?></h4>
                                    <?php if ($testimonio['cargo']): ?>
                                        <p class="cargo"><?php echo htmlspecialchars($testimonio['cargo']); ?></p>
                                    <?php endif; ?>
                                    <?php if ($testimonio['empresa']): ?>
                                        <p class="empresa"><?php echo htmlspecialchars($testimonio['empresa']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; } } else { echo '<div class="alert alert-danger">Error al ejecutar la consulta</div>'; } ?>
                </div>
                <div class="testimonios-controls">
                    <button class="prev-testimonio"><i class="fas fa-chevron-left"></i></button>
                    <button class="next-testimonio"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <section class="certificaciones">
            <div class="container">
                <h2>Nuestras Certificaciones</h2>
                <div class="certificaciones-grid">
                    <?php
                    $sql = "SELECT * FROM certificaciones WHERE activo = 1 ORDER BY orden ASC, fecha_creacion DESC";
                    $stmt = consultaSegura($conexion, $sql, []);
                    if ($stmt) {
                        $result = $stmt->get_result();
                        $certificaciones = $result->fetch_all(MYSQLI_ASSOC);
                        if (empty($certificaciones)) {
                            echo '<div class="alert alert-info">No hay certificaciones disponibles</div>';
                        } else {
                            foreach ($certificaciones as $certificacion):
                    ?>
                    <div class="certificacion-card">
                        <div class="certificacion-imagen">
                            <?php if ($certificacion['imagen']): ?>
                                <img src="<?php echo str_replace('../', '', $certificacion['imagen']); ?>" alt="<?php echo htmlspecialchars($certificacion['titulo']); ?>" class="certificacion-img">
                            <?php else: ?>
                                <div class="imagen-default">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="certificacion-info">
                            <h3><?php echo htmlspecialchars($certificacion['titulo']); ?></h3>
                            <?php if ($certificacion['descripcion']): ?>
                                <div class="certificacion-descripcion">
                                    <?php echo $certificacion['descripcion']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($certificacion['fecha']): ?>
                                <span class="fecha">Obtenido: <?php echo date('d/m/Y', strtotime($certificacion['fecha'])); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; } } else { echo '<div class="alert alert-danger">Error al cargar las certificaciones</div>'; } ?>
                </div>
            </div>
        </section>

        <section class="nuestros-clientes">
            <div class="container">
                <h2>Nuestros Clientes</h2>
                <p class="section-description">Empresas que confían en nuestros servicios</p>
                <div class="clientes-grid">
                    <?php foreach ($clientes as $cliente): ?>
                        <div class="cliente-item">
                            <img src="<?php echo htmlspecialchars($cliente['logo']); ?>" alt="<?php echo htmlspecialchars($cliente['nombre']); ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>¿Listo para trabajar con nosotros?</h2>
                <p>Contáctanos para conocer cómo podemos ayudarte a alcanzar tus objetivos</p>
                <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
            </div>
        </section>
    </main>

    <style>
        body {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: #f4f8fb;
            color: #222;
        }
        .hero {
            background: linear-gradient(135deg, #0a2e73 0%, #1e90ff 100%);
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            overflow: hidden;
        }
        .hero .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            padding: 60px 30px 60px 30px;
        }
        .hero-content {
            flex: 1 1 50%;
            color: #fff;
            text-align: left;
            z-index: 2;
        }
        .hero-content h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.1;
        }
        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 35px;
            color: #e0eaff;
        }
        .cta-buttons {
            display: flex;
            gap: 18px;
        }
        .btn {
            padding: 15px 32px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(30,144,255,0.08);
        }
        .btn-primary {
            background: #fff;
            color: #1e90ff;
        }
        .btn-primary:hover {
            background: #e0eaff;
        }
        .btn-secondary {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
        }
        .btn-secondary:hover {
            background: #1e90ff;
            color: #fff;
            border-color: #1e90ff;
        }
        .hero-image {
            flex: 1 1 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .hero-image img {
            width: 370px;
            height: 470px;
            object-fit: cover;
            border-radius: 30px 30px 120px 30px;
            box-shadow: 0 8px 32px rgba(10,46,115,0.18);
            background: #fff;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -120px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #fff 0%, #1e90ff00 80%);
            opacity: 0.18;
            z-index: 1;
        }
        .services-section {
            background: #fff;
            margin-top: -80px;
            border-radius: 30px;
            box-shadow: 0 8px 32px rgba(30,144,255,0.08);
            padding: 60px 0 40px 0;
            position: relative;
            z-index: 3;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .services-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #0a2e73;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 32px;
            margin: 0 30px;
        }
        .service-card {
            background: #f4f8fb;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(30,144,255,0.07);
            padding: 36px 24px 28px 24px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
        }
        .service-card:hover {
            box-shadow: 0 8px 32px rgba(30,144,255,0.13);
            transform: translateY(-6px) scale(1.03);
        }
        .service-card i {
            font-size: 2.8rem;
            color: #1e90ff;
            margin-bottom: 18px;
        }
        .service-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0a2e73;
            margin-bottom: 10px;
        }
        .service-card p {
            color: #555;
            font-size: 1rem;
        }
        /* Sección de estadísticas */
        .stats-section {
            background: #f4f8fb;
            padding: 60px 0 30px 0;
            text-align: center;
        }
        .stats-title {
            font-size: 2.1rem;
            color: #0a2e73;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .stats-grid {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .stat-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(30,144,255,0.07);
            padding: 36px 32px 28px 32px;
            min-width: 220px;
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            color: #1e90ff;
            font-weight: 700;
        }
        .stat-label {
            color: #0a2e73;
            font-size: 1.1rem;
            margin-top: 8px;
        }
        /* Sección fondo oscuro */
        .dark-section {
            background: linear-gradient(135deg, #0a2e73 0%, #1e90ff 100%);
            color: #fff;
            padding: 70px 0 60px 0;
            text-align: center;
            border-radius: 30px;
            margin: 60px 0 0 0;
        }
        .dark-section h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .dark-section p {
            font-size: 1.1rem;
            color: #e0eaff;
            margin-bottom: 30px;
        }
        .dark-section .btn {
            background: #fff;
            color: #1e90ff;
            border: none;
        }
        .dark-section .btn:hover {
            background: #e0eaff;
        }
        /* Responsive */
        @media (max-width: 900px) {
            .hero .container {
                flex-direction: column;
                text-align: center;
                padding: 40px 10px 40px 10px;
            }
            .hero-content, .hero-image {
                flex: 1 1 100%;
                margin: 0;
            }
            .hero-image {
                margin-top: 30px;
            }
        }
        @media (max-width: 600px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            .services-title, .dark-section h2, .stats-title {
                font-size: 1.3rem;
            }
            .service-card {
                padding: 20px 10px 18px 10px;
            }
            .stat-card {
                padding: 20px 10px 18px 10px;
            }
            .dark-section {
                padding: 40px 0 30px 0;
            }
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.testimonios-carousel');
        const cards = document.querySelectorAll('.testimonio-card');
        const prevBtn = document.querySelector('.prev-testimonio');
        const nextBtn = document.querySelector('.next-testimonio');
        
        if (cards.length > 0) {
            let currentIndex = 0;
            
            function showTestimonio(index) {
                cards.forEach((card, i) => {
                    card.style.display = i === index ? 'block' : 'none';
                });
            }
            
            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + cards.length) % cards.length;
                showTestimonio(currentIndex);
            });
            
            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % cards.length;
                showTestimonio(currentIndex);
            });
            
            // Show first testimonio initially
            showTestimonio(currentIndex);
        } else {
            // Hide controls if no testimonios
            document.querySelector('.testimonios-controls').style.display = 'none';
        }
    });
    </script>

<?php
include('includes/footer.php');
?> 