<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Efecinco'; ?></title>
    <meta name="description" content="<?php echo $data['description'] ?? ''; ?>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo SITE_URL; ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo SITE_URL; ?>">Efecinco</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/quienes-somos">Quiénes Somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/servicios">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/proyectos">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> <?php echo $data['config']['contacto_direccion'] ?? 'Calle 123 #45-67, Bogotá, Colombia'; ?><br>
                        <i class="fas fa-phone"></i> <?php echo $data['config']['contacto_telefono'] ?? '+57 1 234 5678'; ?><br>
                        <i class="fas fa-envelope"></i> <?php echo $data['config']['contacto_email'] ?? 'contacto@efecinco.com'; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>Horario</h5>
                    <p><?php echo $data['config']['horario'] ?? 'Lunes a Viernes: 8:00 AM - 6:00 PM'; ?></p>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <div class="social-links">
                        <?php 
                        $redes_sociales = isset($data['config']['redes_sociales']) ? json_decode($data['config']['redes_sociales'], true) : [
                            'facebook' => 'https://facebook.com/efecinco',
                            'instagram' => 'https://instagram.com/efecinco',
                            'linkedin' => 'https://linkedin.com/company/efecinco'
                        ];
                        ?>
                        <a href="<?php echo $redes_sociales['facebook']; ?>" class="text-white me-2" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?php echo $redes_sociales['instagram']; ?>" class="text-white me-2" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?php echo $redes_sociales['linkedin']; ?>" class="text-white" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
</body>
</html> 