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
    .proyecto-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(transparent, rgba(0, 114, 255, 0.85));
        color: white;
        border-radius: 0 0 16px 16px;
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
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aquí puedes agregar cualquier otro JavaScript que necesites
    });
    </script>

<?php
include('includes/footer.php');
?> 