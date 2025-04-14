<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener certificaciones activas
$sql = "SELECT * FROM certificaciones WHERE activo = 1 ORDER BY fecha_creacion DESC";
$resultado = $conexion->query($sql);
$certificaciones = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificaciones - Efecinco</title>
    <meta name="description" content="Conoce las certificaciones y reconocimientos que respaldan nuestra experiencia en seguridad y tecnología.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Certificaciones</h1>
                <p>Nuestros reconocimientos y certificaciones que respaldan nuestra experiencia y compromiso con la excelencia</p>
            </div>
        </section>

        <section class="certificaciones">
            <div class="container">
                <?php if (empty($certificaciones)): ?>
                    <div class="alert alert-info">
                        <p>Próximamente estaremos compartiendo nuestras certificaciones.</p>
                    </div>
                <?php else: ?>
                    <div class="certificaciones-grid">
                        <?php foreach ($certificaciones as $certificacion): ?>
                            <div class="certificacion-card">
                                <div class="certificacion-imagen">
                                    <?php if ($certificacion['imagen']): ?>
                                        <img src="<?php echo htmlspecialchars($certificacion['imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($certificacion['titulo']); ?>"
                                             loading="lazy">
                                    <?php endif; ?>
                                </div>
                                <div class="certificacion-contenido">
                                    <h3><?php echo htmlspecialchars($certificacion['titulo']); ?></h3>
                                    <?php if ($certificacion['descripcion']): ?>
                                        <p><?php echo htmlspecialchars($certificacion['descripcion']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>¿Interesado en nuestros servicios?</h2>
                <p>Contáctanos para conocer más sobre nuestras soluciones certificadas</p>
                <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
            </div>
        </section>
    </main>

    <?php include('footer.php'); ?>

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/images/hero-certificaciones.jpg');
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

        .certificaciones {
            padding: 80px 0;
        }

        .certificaciones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .certificacion-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .certificacion-card:hover {
            transform: translateY(-5px);
        }

        .certificacion-imagen {
            height: 200px;
            overflow: hidden;
        }

        .certificacion-imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .certificacion-contenido {
            padding: 20px;
        }

        .certificacion-contenido h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .certificacion-contenido p {
            color: #666;
            line-height: 1.6;
        }

        .cta {
            background-color: #f8f9fa;
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
            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .certificaciones-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 