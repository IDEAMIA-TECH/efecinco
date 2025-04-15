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
        <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1520869562399-e772f042f422?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center; background-size: cover;">
            <div class="container">
                <div class="hero-content">
                    <h1>Soluciones en Seguridad y Tecnología</h1>
                    <p>Expertos en implementación de sistemas de seguridad y tecnología para tu empresa</p>
                    <div class="cta-buttons">
                        <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
                        <a href="contacto.php" class="btn btn-secondary">Solicita una cotización</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="sobre-nosotros">
            <div class="container">
                <div class="grid-2-columns">
                    <div class="texto">
                        <h2>Somos F5</h2>
                        <p>Una empresa especialista en soluciones tecnológicas para tu hogar o empresa.</p>
                        <p>Llevamos más de 15 años trabajando con marcas reconocidas en el mercado que dan garantía a cada instalación que realizamos.</p>
                        <p>Contamos con expertos consultores e instaladores que acompañan paso a paso a cada uno de nuestros clientes o proyectos; ayudando siempre, a que cada instalación tenga siempre el mejor resultado.</p>
                        
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
                    <div class="imagen">
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Historia de Efecinco" loading="lazy">
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

        <section class="linea-tiempo">
            <div class="container">
                <h2>Nuestra Trayectoria</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h3>2014</h3>
                            <p>Fundación de Efecinco</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h3>2016</h3>
                            <p>Expansión a nuevos mercados</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h3>2018</h3>
                            <p>Certificación ISO 9001</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h3>2020</h3>
                            <p>Nuevas alianzas estratégicas</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h3>2024</h3>
                            <p>10 años de excelencia y crecimiento</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="servicios-destacados">
            <div class="container">
                <h2>Nuestros Servicios</h2>
                <div class="servicios-grid">
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Cableado Estructurado">
                        </div>
                        <i class="fas fa-network-wired"></i>
                        <h3>Cableado Estructurado</h3>
                        <p>Soluciones de red profesional para tu empresa</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="CCTV">
                        </div>
                        <i class="fas fa-video"></i>
                        <h3>CCTV</h3>
                        <p>Sistemas de videovigilancia de última generación</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="https://images.unsplash.com/photo-1516992654410-9309d4587e94?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Control de Acceso">
                        </div>
                        <i class="fas fa-lock"></i>
                        <h3>Control de Acceso</h3>
                        <p>Gestión segura de accesos a tus instalaciones</p>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 60px; margin-bottom: 30px;">
                    <a href="servicios.php" class="btn btn-primary" style="padding: 12px 30px; font-size: 1.1rem;">
                        <i class="fas fa-arrow-right"></i> Ver todos los servicios
                    </a>
                </div>
            </div>
        </section>

        <section class="proyectos-destacados">
            <div class="container">
                <h2>Proyectos Destacados</h2>
                <div class="proyectos-grid">
                    <?php
                    require_once('includes/db.php');
                    $conexion = conectarDB();
                    
                    // Verificar la conexión
                    if (!$conexion) {
                        echo '<div class="alert alert-danger">Error al conectar con la base de datos</div>';
                    } else {
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
                                        <img src="<?php echo htmlspecialchars($proyecto['imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($proyecto['cliente']); ?>"
                                             class="proyecto-imagen">
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
                                <?php 
                                endforeach;
                            }
                        } else {
                            echo '<div class="alert alert-danger">Error al ejecutar la consulta</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="testimonios">
            <div class="container">
                <h2>Lo que dicen nuestros clientes</h2>
                <div class="testimonios-carousel">
                    <?php
                    require_once('includes/db.php');
                    $conexion = conectarDB();
                    
                    // Verificar la conexión
                    if (!$conexion) {
                        echo '<div class="alert alert-danger">Error al conectar con la base de datos</div>';
                    } else {
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
                                                <img src="<?php echo str_replace('../', '', $testimonio['logo']); ?>" 
                                                     alt="<?php echo htmlspecialchars($testimonio['empresa']); ?>" 
                                                     class="author-logo">
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
                                <?php 
                                endforeach;
                            }
                        } else {
                            echo '<div class="alert alert-danger">Error al ejecutar la consulta</div>';
                        }
                    }
                    ?>
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
                    // Reutilizamos la conexión existente
                    if (!$conexion) {
                        echo '<div class="alert alert-danger">Error al conectar con la base de datos</div>';
                    } else {
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
                                            <img src="<?php echo str_replace('../', '', $certificacion['imagen']); ?>" 
                                                 alt="<?php echo htmlspecialchars($certificacion['titulo']); ?>"
                                                 class="certificacion-img">
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
                                <?php 
                                endforeach;
                            }
                        } else {
                            echo '<div class="alert alert-danger">Error al cargar las certificaciones</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <style>
    .hero {
        color: white;
        text-align: center;
        padding: 200px 0;
        margin-bottom: 60px;
        position: relative;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }

    .hero h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    .btn {
        padding: 15px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #00B4DB;
        color: white;
    }

    .btn-secondary {
        background-color: transparent;
        border: 2px solid white;
        color: white;
    }

    .servicios-destacados, .proyectos-destacados {
        padding: 80px 0;
    }

    .servicios-grid, .proyectos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .servicio-card {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .servicio-card:hover {
        transform: translateY(-10px);
    }

    .servicio-imagen {
        margin-bottom: 20px;
        border-radius: 10px;
        overflow: hidden;
    }

    .servicio-imagen img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .servicio-card:hover .servicio-imagen img {
        transform: scale(1.1);
    }

    .servicio-card i {
        font-size: 2.5rem;
        color: #00B4DB;
        margin: 20px 0;
    }

    .proyecto-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .proyecto-card:hover {
        transform: translateY(-5px);
    }

    .proyecto-imagen {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .proyecto-imagen.default {
        width: 100%;
        height: 250px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    .proyecto-imagen.default i {
        font-size: 3rem;
    }

    .proyecto-card:hover .proyecto-imagen {
        transform: scale(1.05);
    }

    .proyecto-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        color: white;
    }

    .proyecto-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.5rem;
    }

    .proyecto-info .tipo-solucion {
        margin: 0 0 5px 0;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .proyecto-info .descripcion-corta {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .testimonios {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .testimonios h2 {
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }

    .testimonios-carousel {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
        overflow: hidden;
    }

    .testimonio-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 0 15px;
        transition: transform 0.3s ease;
    }

    .testimonio-card:hover {
        transform: translateY(-5px);
    }

    .testimonio-content {
        text-align: center;
    }

    .testimonio-text {
        margin-bottom: 20px;
        position: relative;
    }

    .testimonio-text i {
        color: #00B4DB;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .testimonio-text p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #666;
        font-style: italic;
    }

    .testimonio-author {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .author-logo {
        width: 80px;
        height: 80px;
        object-fit: contain;
        background-color: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .author-logo.default {
        width: 80px;
        height: 80px;
        background-color: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .author-logo.default i {
        font-size: 2rem;
    }

    .author-info {
        text-align: left;
    }

    .author-info h4 {
        margin: 0;
        color: #333;
        font-size: 1.1rem;
    }

    .author-info .cargo {
        margin: 5px 0;
        color: #666;
        font-size: 0.9rem;
    }

    .author-info .empresa {
        margin: 0;
        color: #00B4DB;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .testimonios-controls {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .testimonios-controls button {
        background: #00B4DB;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .testimonios-controls button:hover {
        background: #0099b8;
        transform: scale(1.1);
    }

    .alert {
        padding: 15px;
        margin: 20px 0;
        border-radius: 5px;
        text-align: center;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .testimonio-contenido {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #666;
        font-style: italic;
        margin-top: 15px;
    }

    .testimonio-contenido p {
        margin: 0;
    }

    .testimonio-contenido strong {
        color: #333;
        font-weight: 600;
    }

    .testimonio-contenido em {
        font-style: italic;
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .servicios-grid, .proyectos-grid {
            grid-template-columns: 1fr;
        }
        
        .testimonio-card {
            margin: 0 10px;
            padding: 20px;
        }
        
        .testimonio-text p {
            font-size: 1rem;
        }
        
        .proyecto-imagen {
            height: 200px;
        }
        
        .proyecto-info h3 {
            font-size: 1.2rem;
        }
        
        .proyecto-info .tipo-solucion {
            font-size: 1rem;
        }
        
        .proyecto-info .descripcion-corta {
            font-size: 0.8rem;
        }
    }

    .certificaciones {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .certificaciones h2 {
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }

    .certificaciones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .certificacion-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .certificacion-card:hover {
        transform: translateY(-3px);
    }

    .certificacion-imagen {
        width: 100%;
        height: 150px;
        overflow: hidden;
        position: relative;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }

    .certificacion-img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
    }

    .imagen-default {
        width: 100%;
        height: 100%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .imagen-default i {
        font-size: 3rem;
        color: #6c757d;
    }

    .certificacion-info {
        padding: 15px;
    }

    .certificacion-info h3 {
        margin: 0 0 8px 0;
        font-size: 1.1rem;
        color: #333;
    }

    .certificacion-descripcion {
        margin: 0 0 8px 0;
        color: #666;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .certificacion-descripcion p {
        margin: 0 0 8px 0;
    }

    .certificacion-descripcion p:last-child {
        margin-bottom: 0;
    }

    .certificacion-info .fecha {
        display: block;
        color: #6c757d;
        font-size: 0.75rem;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .certificaciones-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .certificacion-imagen {
            height: 120px;
        }
        
        .certificacion-info h3 {
            font-size: 1rem;
        }
        
        .certificacion-descripcion {
            font-size: 0.8rem;
        }
    }

    .sobre-nosotros {
        padding: 80px 0;
    }

    .grid-2-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .texto h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .texto p {
        color: #666;
        line-height: 1.6;
    }

    .imagen img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .mision-vision {
        background-color: #f8f9fa;
        padding: 80px 0;
    }

    .mision-vision .card {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .mision-vision .card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .mision-vision .card h3 {
        margin-bottom: 15px;
        color: #333;
    }

    .mision-vision .card p {
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .grid-2-columns {
            grid-template-columns: 1fr;
        }
        
        .imagen img {
            height: 300px;
        }
        
        .mision-vision .card {
            padding: 20px;
        }
    }

    .linea-tiempo {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .linea-tiempo h2 {
        text-align: center;
        margin-bottom: 50px;
        color: #333;
    }

    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .timeline::before {
        content: '';
        position: absolute;
        width: 2px;
        background-color: #00B4DB;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -1px;
    }

    .timeline-item {
        padding: 20px 0;
        position: relative;
    }

    .timeline-content {
        position: relative;
        width: 45%;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-left: 50%;
    }

    .timeline-item:nth-child(even) .timeline-content {
        margin-right: 50%;
    }

    .timeline-content h3 {
        color: #00B4DB;
        margin-bottom: 10px;
    }

    .timeline-content p {
        color: #666;
        margin: 0;
    }

    @media (max-width: 768px) {
        .timeline::before {
            left: 30px;
        }

        .timeline-content {
            width: calc(100% - 60px);
            margin-left: 60px !important;
        }
    }

    .caracteristicas {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .caracteristica-item {
        text-align: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .caracteristica-item:hover {
        transform: translateY(-5px);
    }

    .caracteristica-item i {
        font-size: 2.5rem;
        color: #00B4DB;
        margin-bottom: 15px;
    }

    .caracteristica-item h3 {
        color: #333;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .caracteristica-item p {
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .caracteristicas {
            grid-template-columns: 1fr;
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