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
                    <h1>Tu Socio en Soluciones Digitales</h1>
                    <p>Impulsamos la innovación y la seguridad tecnológica en tu empresa con soluciones de clase mundial.</p>
                    <div class="cta-buttons">
                        <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
                        <a href="contacto.php" class="btn btn-secondary">Solicita una cotización</a>
                    </div>
                </div>
                <img class="hero-img" src="https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&w=600&q=80" alt="Profesional IT" />
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

        <section class="servicios-destacados">
            <div class="container">
                <h2>Nuestros Servicios</h2>
                <div class="servicios-grid">
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-1.png" alt="Cableado Estructurado">
                        </div>
                        <i class="fas fa-network-wired"></i>
                        <h3>Cableado Estructurado</h3>
                        <p>Soluciones de red profesional para tu empresa</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-2.png" alt="CCTV">
                        </div>
                        <i class="fas fa-video"></i>
                        <h3>CCTV</h3>
                        <p>Sistemas de videovigilancia de última generación</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-3.png" alt="Control de Acceso">
                        </div>
                        <i class="fas fa-lock"></i>
                        <h3>Control de Acceso</h3>
                        <p>Gestión segura de accesos a tus instalaciones</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-4.png" alt="Sistemas de Alarma">
                        </div>
                        <i class="fas fa-bell"></i>
                        <h3>Sistemas de Alarma</h3>
                        <p>Protección integral para tu hogar o negocio</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-5.png" alt="Automatización">
                        </div>
                        <i class="fas fa-robot"></i>
                        <h3>Automatización</h3>
                        <p>Soluciones inteligentes para tu espacio</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-6.png" alt="Sistemas de Audio">
                        </div>
                        <i class="fas fa-volume-up"></i>
                        <h3>Sistemas de Audio</h3>
                        <p>Experiencia sonora profesional</p>
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

        <section class="nuestros-clientes">
            <div class="container">
                <h2>Nuestros Clientes</h2>
                <p class="section-description">Empresas que confían en nuestros servicios</p>
                <div class="clientes-grid">
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-a.png" alt="Cliente A" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-b.png" alt="Cliente B" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-c.png" alt="Cliente C" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-d.png" alt="Cliente D" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-e.png" alt="Cliente E" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-f.png" alt="Cliente F" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-g.png" alt="Cliente G" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-h.png" alt="Cliente H" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-i.png" alt="Cliente I" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-j.png" alt="Cliente J" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-k.png" alt="Cliente K" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-l.png" alt="Cliente L" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-m.png" alt="Cliente M" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-n.png" alt="Cliente N" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-o.png" alt="Cliente O" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-p.png" alt="Cliente P" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-q.png" alt="Cliente Q" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-r.png" alt="Cliente R" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-s.png" alt="Cliente S" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-t.png" alt="Cliente T" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-u.png" alt="Cliente U" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-v.png" alt="Cliente V" loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="assets/images/clientes/client-w.png" alt="Cliente W" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
    body {
        background: linear-gradient(135deg, #0a1f44 0%, #1e3a8a 100%);
        color: #fff;
        font-family: 'Segoe UI', 'Arial', sans-serif;
    }
    .hero {
        background: linear-gradient(120deg, #1e3a8a 60%, #2563eb 100%);
        background-image: url('https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=1500&q=80');
        background-blend-mode: multiply;
        background-size: cover;
        background-position: center;
        color: #fff;
        text-align: left;
        padding: 120px 0 80px 0;
        position: relative;
        min-height: 500px;
        display: flex;
        align-items: center;
    }
    .hero .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .hero-content {
        max-width: 600px;
        z-index: 2;
    }
    .hero-content h1 {
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.1;
        color: #fff;
        text-shadow: 0 4px 24px rgba(10,31,68,0.3);
    }
    .hero-content p {
        font-size: 1.3rem;
        margin-bottom: 30px;
        color: #e0e7ef;
    }
    .hero-img {
        max-width: 400px;
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(30,58,138,0.25);
        margin-left: 40px;
    }
    .cta-buttons .btn-primary {
        background: linear-gradient(90deg, #2563eb 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 15px 40px;
        border-radius: 30px;
        box-shadow: 0 4px 16px rgba(30,58,138,0.15);
        margin-right: 15px;
        transition: background 0.3s;
    }
    .cta-buttons .btn-primary:hover {
        background: linear-gradient(90deg, #60a5fa 0%, #2563eb 100%);
    }
    .cta-buttons .btn-secondary {
        background: transparent;
        border: 2px solid #60a5fa;
        color: #60a5fa;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 15px 40px;
        border-radius: 30px;
        transition: all 0.3s;
    }
    .cta-buttons .btn-secondary:hover {
        background: #60a5fa;
        color: #fff;
    }
    .servicios-destacados {
        background: #13204a;
        padding: 80px 0 60px 0;
    }
    .servicios-destacados h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5rem;
    }
    .servicios-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
    }
    .servicio-card {
        background: #1e3a8a;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(30,58,138,0.10);
        padding: 40px 30px 30px 30px;
        text-align: center;
        width: 320px;
        color: #fff;
        margin-bottom: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .servicio-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 8px 32px rgba(30,58,138,0.18);
    }
    .servicio-imagen img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-bottom: 20px;
        border-radius: 50%;
        background: #fff;
        padding: 10px;
        box-shadow: 0 2px 8px rgba(96,165,250,0.10);
    }
    .servicio-card i {
        font-size: 2.2rem;
        color: #60a5fa;
        margin: 20px 0 10px 0;
    }
    .servicio-card h3 {
        color: #fff;
        margin-bottom: 10px;
        font-size: 1.3rem;
        font-weight: 600;
    }
    .servicio-card p {
        color: #cbd5e1;
        font-size: 1rem;
        margin: 0;
    }
    .proyectos-destacados {
        background: #0a1f44;
        padding: 80px 0 60px 0;
    }
    .proyectos-destacados h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5rem;
    }
    .proyectos-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
    }
    .proyecto-card {
        background: #1e3a8a;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(30,58,138,0.10);
        overflow: hidden;
        width: 350px;
        margin-bottom: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .proyecto-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 8px 32px rgba(30,58,138,0.18);
    }
    .proyecto-imagen {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .proyecto-info {
        padding: 25px 20px 20px 20px;
        color: #fff;
    }
    .proyecto-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.2rem;
        font-weight: 600;
    }
    .proyecto-info .tipo-solucion {
        font-size: 1rem;
        color: #60a5fa;
        margin-bottom: 5px;
    }
    .proyecto-info .descripcion-corta {
        font-size: 0.95rem;
        color: #cbd5e1;
    }
    .testimonios {
        background: #13204a;
        padding: 80px 0 60px 0;
    }
    .testimonios h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5rem;
    }
    .testimonios-carousel {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
    }
    .testimonio-card {
        background: #1e3a8a;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(30,58,138,0.10);
        padding: 40px 30px 30px 30px;
        color: #fff;
        width: 350px;
        margin-bottom: 20px;
        text-align: left;
    }
    .testimonio-content {
        margin-bottom: 20px;
    }
    .testimonio-text i {
        color: #60a5fa;
        font-size: 2rem;
        margin-bottom: 10px;
    }
    .testimonio-contenido {
        font-size: 1.1rem;
        color: #cbd5e1;
        margin-top: 10px;
    }
    .testimonio-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .author-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
        background-color: #fff;
        border-radius: 50%;
        padding: 8px;
        box-shadow: 0 2px 8px rgba(96,165,250,0.10);
    }
    .author-info h4 {
        margin: 0;
        color: #fff;
        font-size: 1.1rem;
    }
    .author-info .cargo, .author-info .empresa {
        color: #60a5fa;
        font-size: 0.95rem;
        margin: 0;
    }
    .nuestros-clientes {
        background: #0a1f44;
        padding: 80px 0 60px 0;
    }
    .nuestros-clientes h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 20px;
        font-size: 2.5rem;
    }
    .section-description {
        text-align: center;
        color: #cbd5e1;
        margin-bottom: 50px;
        font-size: 1.2rem;
    }
    .clientes-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
    }
    .cliente-item {
        background: #1e3a8a;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(30,58,138,0.10);
        padding: 20px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 160px;
        min-height: 80px;
        margin-bottom: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .cliente-item img {
        max-width: 100px;
        max-height: 60px;
        object-fit: contain;
        filter: grayscale(100%);
        transition: filter 0.3s;
    }
    .cliente-item:hover img {
        filter: grayscale(0%);
    }
    @media (max-width: 900px) {
        .hero .container {
            flex-direction: column;
            text-align: center;
        }
        .hero-img {
            margin: 40px 0 0 0;
        }
        .servicios-grid, .proyectos-grid, .testimonios-carousel, .clientes-grid {
            flex-direction: column;
            gap: 20px;
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