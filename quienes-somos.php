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
    <?php include('includes/header.php'); ?>

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

        <section class="clientes">
            <div class="container">
                <h2>Nuestros Clientes</h2>
                <div class="clientes-grid">
                    <div class="cliente-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Walmart_Spark.svg/2560px-Walmart_Spark.svg.png" 
                             alt="Walmart" 
                             loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Liverpool_logo.svg/2560px-Liverpool_logo.svg.png" 
                             alt="Liverpool" 
                             loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Chedraui_logo.svg/2560px-Chedraui_logo.svg.png" 
                             alt="Chedraui" 
                             loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/OXXO_Logo.svg/2560px-OXXO_Logo.svg.png" 
                             alt="OXXO" 
                             loading="lazy">
                    </div>
                    <div class="cliente-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Soriana_logo.svg/2560px-Soriana_logo.svg.png" 
                             alt="Soriana" 
                             loading="lazy">
                    </div>
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

    <?php include('includes/footer.php'); ?>

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
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
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 120px;
        }

        .cliente-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .cliente-item img {
            max-width: 100%;
            height: auto;
            max-height: 80px;
            width: auto;
            object-fit: contain;
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
        }
    </style>
</body>
</html> 