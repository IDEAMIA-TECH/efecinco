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
    <title>Quiénes Somos - Efecinco</title>
    <meta name="description" content="Conoce más sobre Efecinco, nuestra misión, visión y trayectoria en el sector de seguridad y tecnología.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Quiénes Somos</h1>
                <p>Conoce nuestra historia, misión y compromiso con la excelencia</p>
            </div>
        </section>

        <section class="sobre-nosotros">
            <div class="container">
                <div class="grid-2-columns">
                    <div class="texto">
                        <h2>Nuestra Historia</h2>
                        <p><?php echo nl2br(htmlspecialchars($empresa['historia'] ?? '')); ?></p>
                    </div>
                    <div class="imagen">
                        <img src="assets/images/historia-empresa.jpg" alt="Historia de Efecinco" loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <section class="mision-vision">
            <div class="container">
                <div class="grid-2-columns">
                    <div class="card">
                        <i class="fas fa-bullseye"></i>
                        <h3>Misión</h3>
                        <p><?php echo nl2br(htmlspecialchars($empresa['mision'] ?? '')); ?></p>
                    </div>
                    <div class="card">
                        <i class="fas fa-eye"></i>
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

        <section class="clientes">
            <div class="container">
                <h2>Nuestros Clientes</h2>
                <div class="clientes-grid">
                    <?php foreach ($clientes as $cliente): ?>
                        <div class="cliente-item">
                            <img src="<?php echo htmlspecialchars($cliente['logo']); ?>" 
                                 alt="<?php echo htmlspecialchars($cliente['nombre']); ?>"
                                 loading="lazy">
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

    <?php include('footer.php'); ?>

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/images/hero-quienes-somos.jpg');
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
        }

        .mision-vision .card i {
            font-size: 2.5rem;
            color: #007bff;
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

        .linea-tiempo {
            padding: 80px 0;
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
            background-color: #007bff;
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
            color: #007bff;
            margin-bottom: 10px;
        }

        .timeline-content p {
            color: #666;
            margin: 0;
        }

        .clientes {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .clientes h2 {
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .clientes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 30px;
            align-items: center;
        }

        .cliente-item {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cliente-item img {
            max-width: 100%;
            height: auto;
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }

        .cliente-item:hover img {
            filter: grayscale(0%);
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

            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-content {
                width: calc(100% - 60px);
                margin-left: 60px !important;
            }
        }
    </style>
</body>
</html> 