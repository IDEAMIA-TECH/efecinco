<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener ID del servicio
$id = $_GET['id'] ?? 0;

// Obtener información del servicio
$sql = "SELECT * FROM servicios WHERE id = ? AND activo = 1";
$stmt = consultaSegura($conexion, $sql, [$id]);
$servicio = $stmt->get_result()->fetch_assoc();

// Si no se encuentra el servicio, redirigir a la página de servicios
if (!$servicio) {
    header('Location: servicios.php');
    exit;
}

// Obtener proyectos relacionados
$sql = "SELECT p.* FROM proyectos p 
        INNER JOIN proyecto_servicio ps ON p.id = ps.proyecto_id 
        WHERE ps.servicio_id = ? AND p.activo = 1 
        ORDER BY p.fecha DESC LIMIT 3";
$stmt = consultaSegura($conexion, $sql, [$id]);
$proyectos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($servicio['nombre']); ?> - Efecinco</title>
    <meta name="description" content="<?php echo htmlspecialchars($servicio['descripcion_corta']); ?>">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1><?php echo htmlspecialchars($servicio['nombre']); ?></h1>
                <p><?php echo htmlspecialchars($servicio['descripcion_corta']); ?></p>
            </div>
        </section>

        <section class="servicio-detalle">
            <div class="container">
                <div class="grid-2-columns">
                    <div class="servicio-info">
                        <div class="servicio-icono">
                            <i class="<?php echo htmlspecialchars($servicio['icono']); ?>"></i>
                        </div>
                        <h2>Descripción del Servicio</h2>
                        <div class="servicio-descripcion">
                            <?php echo nl2br(htmlspecialchars($servicio['descripcion'])); ?>
                        </div>

                        <?php if ($servicio['caracteristicas']): ?>
                            <h3>Características Principales</h3>
                            <ul class="caracteristicas">
                                <?php foreach (explode("\n", $servicio['caracteristicas']) as $caracteristica): ?>
                                    <li>
                                        <i class="fas fa-check"></i>
                                        <?php echo htmlspecialchars(trim($caracteristica)); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($servicio['beneficios']): ?>
                            <h3>Beneficios</h3>
                            <ul class="beneficios">
                                <?php foreach (explode("\n", $servicio['beneficios']) as $beneficio): ?>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <?php echo htmlspecialchars(trim($beneficio)); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <div class="servicio-imagen">
                        <?php if ($servicio['imagen']): ?>
                            <img src="<?php echo htmlspecialchars($servicio['imagen']); ?>" 
                                 alt="<?php echo htmlspecialchars($servicio['nombre']); ?>"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php if (!empty($proyectos)): ?>
            <section class="proyectos-relacionados">
                <div class="container">
                    <h2>Proyectos Relacionados</h2>
                    <div class="proyectos-grid">
                        <?php foreach ($proyectos as $proyecto): ?>
                            <div class="proyecto-card">
                                <?php if ($proyecto['imagen']): ?>
                                    <div class="proyecto-imagen">
                                        <img src="<?php echo htmlspecialchars($proyecto['imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($proyecto['cliente']); ?>"
                                             loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="proyecto-contenido">
                                    <h3><?php echo htmlspecialchars($proyecto['cliente']); ?></h3>
                                    <p><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                                    <a href="proyecto.php?id=<?php echo $proyecto['id']; ?>" class="btn btn-outline">
                                        Ver proyecto
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="cta">
            <div class="container">
                <h2>¿Interesado en este servicio?</h2>
                <p>Contáctanos para una asesoría personalizada</p>
                <a href="contacto.php" class="btn btn-primary">Solicitar Asesoría</a>
            </div>
        </section>
    </main>

    <?php include('footer.php'); ?>

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/images/hero-servicio.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 0;
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

        .servicio-detalle {
            padding: 80px 0;
        }

        .grid-2-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .servicio-info {
            padding-right: 20px;
        }

        .servicio-icono {
            background: #007bff;
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .servicio-icono i {
            font-size: 2rem;
        }

        .servicio-info h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .servicio-descripcion {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .servicio-info h3 {
            margin: 30px 0 15px;
            color: #333;
        }

        .caracteristicas,
        .beneficios {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .caracteristicas li,
        .beneficios li {
            margin-bottom: 10px;
            color: #666;
            display: flex;
            align-items: flex-start;
        }

        .caracteristicas li i,
        .beneficios li i {
            color: #007bff;
            margin-right: 10px;
            margin-top: 5px;
        }

        .servicio-imagen img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .proyectos-relacionados {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .proyectos-relacionados h2 {
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .proyectos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .proyecto-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .proyecto-imagen {
            height: 200px;
            overflow: hidden;
        }

        .proyecto-imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .proyecto-contenido {
            padding: 20px;
        }

        .proyecto-contenido h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .proyecto-contenido p {
            color: #666;
            margin-bottom: 20px;
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
            .grid-2-columns {
                grid-template-columns: 1fr;
            }

            .servicio-info {
                padding-right: 0;
            }

            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .proyectos-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 