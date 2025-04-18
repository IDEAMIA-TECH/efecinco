<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener ID del proyecto
$id = $_GET['id'] ?? 0;

// Obtener información del proyecto
$sql = "SELECT * FROM proyectos WHERE id = ? AND activo = 1";
$stmt = consultaSegura($conexion, $sql, [$id]);
$proyecto = $stmt->get_result()->fetch_assoc();

// Si no se encuentra el proyecto, redirigir a la página de proyectos
if (!$proyecto) {
    header('Location: proyectos.php');
    exit;
}

// Obtener servicios relacionados
$sql = "SELECT s.* FROM servicios s 
        INNER JOIN proyecto_servicio ps ON s.id = ps.servicio_id 
        WHERE ps.proyecto_id = ? AND s.activo = 1 
        ORDER BY s.nombre";
$stmt = consultaSegura($conexion, $sql, [$id]);
$servicios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener imágenes adicionales del proyecto
$sql = "SELECT * FROM proyecto_imagenes WHERE proyecto_id = ? ORDER BY orden";
$stmt = consultaSegura($conexion, $sql, [$id]);
$imagenes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($proyecto['cliente']); ?> - Efecinco</title>
    <meta name="description" content="<?php echo htmlspecialchars($proyecto['descripcion']); ?>">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://source.unsplash.com/random/1920x1080/?technology,office') no-repeat center center; background-size: cover;">
            <div class="container">
                <h1><?php echo htmlspecialchars($proyecto['cliente']); ?></h1>
                <p><?php echo htmlspecialchars($proyecto['tipo_solucion']); ?></p>
            </div>
        </section>

        <section class="proyecto-detalle">
            <div class="container">
                <div class="grid-2-columns">
                    <div class="proyecto-info">
                        <h2>Descripción del Proyecto</h2>
                        <div class="proyecto-descripcion">
                            <?php echo nl2br(htmlspecialchars($proyecto['descripcion'])); ?>
                        </div>

                        <?php if ($proyecto['caracteristicas']): ?>
                            <h3>Características del Proyecto</h3>
                            <ul class="caracteristicas">
                                <?php foreach (explode("\n", $proyecto['caracteristicas']) as $caracteristica): ?>
                                    <li>
                                        <i class="fas fa-check"></i>
                                        <?php echo htmlspecialchars(trim($caracteristica)); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($servicios)): ?>
                            <h3>Servicios Implementados</h3>
                            <div class="servicios-grid">
                                <?php foreach ($servicios as $servicio): ?>
                                    <div class="servicio-card">
                                        <div class="servicio-icono">
                                            <i class="<?php echo htmlspecialchars($servicio['icono']); ?>"></i>
                                        </div>
                                        <h4><?php echo htmlspecialchars($servicio['nombre']); ?></h4>
                                        <p><?php echo htmlspecialchars($servicio['descripcion_corta']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="proyecto-imagen-principal">
                        <?php if ($proyecto['imagen']): ?>
                            <img src="<?php echo htmlspecialchars($proyecto['imagen']); ?>" 
                                 alt="<?php echo htmlspecialchars($proyecto['cliente']); ?>"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($imagenes)): ?>
                    <div class="galeria-proyecto">
                        <h3>Galería del Proyecto</h3>
                        <div class="galeria-grid">
                            <?php foreach ($imagenes as $imagen): ?>
                                <a href="<?php echo htmlspecialchars($imagen['url']); ?>" 
                                   data-lightbox="galeria-proyecto"
                                   data-title="<?php echo htmlspecialchars($imagen['descripcion']); ?>">
                                    <img src="<?php echo htmlspecialchars($imagen['url']); ?>" 
                                         alt="<?php echo htmlspecialchars($imagen['descripcion']); ?>"
                                         loading="lazy">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>¿Tienes un proyecto similar?</h2>
                <p>Contáctanos para una asesoría personalizada</p>
                <a href="contacto.php" class="btn btn-primary">Solicitar Asesoría</a>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <style>
        .hero {
            color: white;
            text-align: center;
            padding: 100px 0;
            position: relative;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .proyecto-detalle {
            padding: 80px 0;
        }
        .grid-2-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
            margin-bottom: 60px;
        }
        .proyecto-info {
            padding-right: 20px;
        }
        .proyecto-info h2 {
            margin-bottom: 20px;
            color: #0072ff;
            font-weight: 700;
        }
        .proyecto-descripcion {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .proyecto-info h3 {
            margin: 30px 0 15px;
            color: #0072ff;
            font-weight: 600;
        }
        .caracteristicas {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .caracteristicas li {
            margin-bottom: 10px;
            color: #666;
            display: flex;
            align-items: flex-start;
        }
        .caracteristicas li i {
            color: #0072ff;
            margin-right: 10px;
            margin-top: 5px;
        }
        .servicios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .servicio-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s;
        }
        .servicio-card:hover {
            transform: translateY(-5px);
        }
        .servicio-icono {
            background: #0072ff;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        .servicio-icono i {
            font-size: 1.5rem;
        }
        .servicio-card h4 {
            margin-bottom: 10px;
            color: #0072ff;
        }
        .servicio-card p {
            color: #666;
            font-size: 0.9rem;
        }
        .proyecto-imagen-principal img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .galeria-proyecto {
            margin-top: 60px;
        }
        .galeria-proyecto h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #0072ff;
            font-weight: 700;
        }
        .galeria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .galeria-grid a {
            display: block;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .galeria-grid a:hover {
            transform: scale(1.05);
        }
        .galeria-grid img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .cta {
            padding: 60px 0;
            text-align: center;
            background: linear-gradient(120deg, #f4f8fb 60%, #e3f0fa 100%);
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
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-primary {
            background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(0,180,219,0.08);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,114,255,0.18);
        }
        @media (max-width: 768px) {
            .grid-2-columns {
                grid-template-columns: 1fr;
            }
            .proyecto-info {
                padding-right: 0;
            }
            .hero {
                padding: 60px 0;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
            .servicios-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 