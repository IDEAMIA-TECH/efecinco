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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1520869562399-e772f042f422?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center; background-size: cover;">
            <div class="container">
                <div class="hero-content">
                    <img src="assets/images/logof5.png" alt="Logo F5" class="hero-logo">
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
                <div class="texto">
                    <img src="assets/images/logof5.png" alt="Logo F5" class="about-logo">
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
                        <h3>Cableado Estructurado</h3>
                        <p>Soluciones de red profesional para tu empresa</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-2.png" alt="CCTV">
                        </div>
                        <h3>CCTV</h3>
                        <p>Sistemas de videovigilancia de última generación</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-3.png" alt="Control de Acceso">
                        </div>
                        <h3>Control de Acceso</h3>
                        <p>Gestión segura de accesos a tus instalaciones</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-4.png" alt="Sistemas de Alarma">
                        </div>
                        <h3>Sistemas de Alarma</h3>
                        <p>Protección integral para tu hogar o negocio</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-5.png" alt="Automatización">
                        </div>
                        <h3>Automatización</h3>
                        <p>Soluciones inteligentes para tu espacio</p>
                    </div>
                    <div class="servicio-card">
                        <div class="servicio-imagen">
                            <img src="assets/images/project-6.png" alt="Sistemas de Audio">
                        </div>
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
                <div class="row">
                    <?php
                    // Verificar la conexión a la base de datos
                    if ($conexion->connect_error) {
                        echo '<div class="alert alert-danger">Error de conexión a la base de datos</div>';
                    } else {
                        // Consulta para obtener los proyectos destacados
                        $sql = "SELECT id, nombre, tipo_solucion, descripcion_corta, imagen FROM proyectos WHERE destacado = 1 AND activo = 1 ORDER BY orden LIMIT 3";
                        $resultado = $conexion->query($sql);

                        if ($resultado && $resultado->num_rows > 0) {
                            while ($proyecto = $resultado->fetch_assoc()) {
                                ?>
                                <div class="col-md-4 mb-4">
                                    <a href="proyecto.php?id=<?php echo $proyecto['id']; ?>" class="text-decoration-none">
                                        <div class="proyecto-card">
                                            <?php if (!empty($proyecto['imagen']) && file_exists($proyecto['imagen'])) { ?>
                                                <img src="<?php echo $proyecto['imagen']; ?>" alt="<?php echo htmlspecialchars($proyecto['nombre']); ?>" class="proyecto-imagen">
                                            <?php } else { ?>
                                                <div class="proyecto-imagen default">
                                                    <i class="fas fa-project-diagram"></i>
                                                </div>
                                            <?php } ?>
                                            <div class="proyecto-info">
                                                <div class="tipo-solucion"><?php echo htmlspecialchars($proyecto['tipo_solucion']); ?></div>
                                                <h3><?php echo htmlspecialchars($proyecto['nombre']); ?></h3>
                                                <p class="descripcion-corta"><?php echo htmlspecialchars($proyecto['descripcion_corta']); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="col-12"><div class="alert alert-info">No hay proyectos destacados disponibles.</div></div>';
                        }
                    }
                    ?>
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
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        background: #f4f8fb;
        color: #222;
    }
    .hero {
        color: white;
        text-align: center;
        padding: 200px 0;
        margin-bottom: 60px;
        position: relative;
        background: linear-gradient(120deg, #00B4DB 0%, #0072ff 100%);
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
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }
    .hero h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        text-shadow: 2px 2px 8px rgba(0,180,219,0.2);
        font-weight: 700;
        letter-spacing: 2px;
    }
    .hero p {
        font-size: 1.3rem;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0,180,219,0.15);
        font-weight: 400;
    }
    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
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
    }
    .btn-primary {
        background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(0,180,219,0.15);
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #0072ff 0%, #00B4DB 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 18px rgba(0,114,255,0.18);
    }
    .btn-secondary {
        background: transparent;
        border: 2px solid #00B4DB;
        color: #00B4DB;
    }
    .btn-secondary:hover {
        background: #00B4DB;
        color: #fff;
        border-color: #0072ff;
        transform: translateY(-2px) scale(1.04);
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
        padding: 20px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,180,219,0.07);
        transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s;
        border: 1px solid #e3f0fa;
    }
    .servicio-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(0,114,255,0.13);
    }
    .servicio-imagen {
        margin-bottom: 20px;
        border-radius: 10px;
        overflow: hidden;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f8fb;
    }
    .servicio-imagen img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .servicio-card h3 {
        color: #0072ff;
        margin: 15px 0;
        font-size: 1.5rem;
        font-weight: 700;
    }
    .servicio-card p {
        color: #444;
        line-height: 1.6;
        margin: 0;
    }
    .proyecto-card {
        position: relative;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,180,219,0.07);
        transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s;
        border: 1px solid #e3f0fa;
        height: 300px;
    }
    .proyecto-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(0,114,255,0.13);
    }
    .proyecto-imagen {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .proyecto-imagen.default {
        background: #f4f8fb;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    .proyecto-imagen.default i {
        font-size: 3rem;
        color: #6c757d;
    }
    .proyecto-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        color: white;
        border-radius: 0 0 16px 16px;
    }
    .proyecto-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.5rem;
        color: #fff;
        font-weight: 600;
    }
    .proyecto-info .tipo-solucion {
        margin: 0 0 5px 0;
        font-size: 1.1rem;
        font-weight: 500;
        color: #00B4DB;
    }
    .proyecto-info .descripcion-corta {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.9;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.4;
    }
    .alert-danger {
        background-color: #ffe5e9;
        color: #d32f2f;
        border: 1px solid #f5c6cb;
    }
    .alert-info {
        background-color: #e3f0fa;
        color: #0072ff;
        border: 1px solid #bee5eb;
    }
    .certificaciones {
        padding: 80px 0;
        background: linear-gradient(120deg, #f4f8fb 60%, #e3f0fa 100%);
    }
    .certificaciones h2 {
        text-align: center;
        margin-bottom: 40px;
        color: #0072ff;
        font-weight: 700;
    }
    .certificaciones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .certificacion-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,180,219,0.08);
        transition: transform 0.3s;
        border: 1px solid #e3f0fa;
    }
    .certificacion-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(0,114,255,0.13);
    }
    .certificacion-imagen {
        width: 100%;
        height: 150px;
        overflow: hidden;
        position: relative;
        background-color: #f4f8fb;
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
        background-color: #e3f0fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .imagen-default i {
        font-size: 3rem;
        color: #6c757d;
    }
    .certificacion-info h3 {
        margin: 0 0 8px 0;
        font-size: 1.1rem;
        color: #0072ff;
        font-weight: 600;
    }
    .certificacion-descripcion {
        margin: 0 0 8px 0;
        color: #666;
        font-size: 0.85rem;
        line-height: 1.4;
    }
    .certificacion-info .fecha {
        display: block;
        color: #6c757d;
        font-size: 0.75rem;
        font-style: italic;
    }
    .sobre-nosotros {
        padding: 80px 0;
        background-color: #fff;
    }
    .sobre-nosotros .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .sobre-nosotros .texto {
        text-align: center;
        margin-bottom: 50px;
    }
    .sobre-nosotros h2 {
        font-size: 2.5rem;
        color: #0072ff;
        margin-bottom: 20px;
        font-weight: 700;
    }
    .sobre-nosotros p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .caracteristicas {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 30px;
    }
    .caracteristica-item {
        text-align: center;
        padding: 30px;
        background: #e3f0fa;
        border-radius: 10px;
        transition: all 0.3s;
        box-shadow: 0 4px 16px rgba(0,180,219,0.08);
    }
    .caracteristica-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,114,255,0.13);
    }
    .caracteristica-item i {
        font-size: 2.5rem;
        color: #00B4DB;
        margin-bottom: 20px;
    }
    .caracteristica-item h3 {
        color: #0072ff;
        margin-bottom: 15px;
        font-size: 1.2rem;
        font-weight: 600;
    }
    .caracteristica-item p {
        color: #444;
        line-height: 1.6;
        margin: 0;
    }
    .mision-vision {
        background: linear-gradient(120deg, #f4f8fb 60%, #e3f0fa 100%);
        padding: 80px 0;
    }
    .mision-vision .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .grid-2-columns {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }
    .mision-vision .card {
        text-align: center;
        padding: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0,180,219,0.08);
        transition: transform 0.3s;
    }
    .mision-vision .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,114,255,0.13);
    }
    .mision-vision .card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
    }
    .mision-vision .card h3 {
        color: #00B4DB;
        margin-bottom: 15px;
        font-size: 1.5rem;
        font-weight: 700;
    }
    .mision-vision .card p {
        color: #444;
        line-height: 1.6;
        margin: 0;
    }
    .nuestros-clientes {
        padding: 80px 0;
        background-color: #fff;
    }
    .nuestros-clientes h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #0072ff;
        font-size: 2.5rem;
        font-weight: 700;
    }
    .section-description {
        text-align: center;
        color: #666;
        margin-bottom: 50px;
        font-size: 1.2rem;
    }
    .clientes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .cliente-item {
        text-align: center;
        padding: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0,180,219,0.08);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 120px;
    }
    .cliente-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,114,255,0.13);
    }
    .cliente-item img {
        max-width: 100%;
        height: auto;
        max-height: 80px;
        width: auto;
        object-fit: contain;
        filter: grayscale(100%);
        transition: filter 0.3s;
    }
    .cliente-item:hover img {
        filter: grayscale(0%);
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
        .proyecto-card {
            height: 250px;
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
        .caracteristicas {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .sobre-nosotros {
            padding: 60px 0;
        }
        .sobre-nosotros h2 {
            font-size: 2rem;
        }
        .grid-2-columns {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .mision-vision {
            padding: 60px 0;
        }
        .mision-vision .card {
            padding: 20px;
        }
        .mision-vision .card img {
            width: 100px;
            height: 100px;
        }
        .clientes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .cliente-item {
            padding: 20px;
            min-height: 100px;
        }
        .cliente-item img {
            max-height: 60px;
        }
        .nuestros-clientes h2 {
            font-size: 2rem;
        }
    }
    .hero-logo {
        max-width: 200px;
        height: auto;
        margin-bottom: 30px;
    }
    .about-logo {
        max-width: 150px;
        height: auto;
        margin-bottom: 20px;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aquí puedes agregar cualquier otro JavaScript que necesites
    });
    </script>

<?php
include('includes/footer.php');
?> 