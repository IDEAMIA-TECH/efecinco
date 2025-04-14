<?php
// El contenido se capturará automáticamente por el buffer
?>

<div class="bg-white">
    <!-- Hero Section -->
    <section class="hero bg-gradient-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="<?php echo SITE_URL; ?>/assets/images/logo/logof5.png" 
                         alt="Efe Cinco Logo" 
                         class="img-fluid mb-4" 
                         style="max-width: 300px;">
                    <h1 class="display-4 fw-bold">¿Quiénes Somos?</h1>
                    <p class="lead">Somos una empresa líder en soluciones tecnológicas y de seguridad, comprometida con la excelencia y la innovación.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&h=400&q=80" 
                         alt="Efecinco Team" 
                         class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Misión y Visión -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-bullseye fa-3x mb-3 text-primary"></i>
                            <h2 class="card-title h4">Nuestra Misión</h2>
                            <p class="card-text"><?= htmlspecialchars($empresa['mision']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-eye fa-3x mb-3 text-primary"></i>
                            <h2 class="card-title h4">Nuestra Visión</h2>
                            <p class="card-text"><?= htmlspecialchars($empresa['vision']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Valores -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Nuestros Valores</h2>
            <div class="row">
                <?php 
                $iconos = [
                    'Excelencia' => 'fa-star',
                    'Innovación' => 'fa-lightbulb',
                    'Integridad' => 'fa-shield-alt',
                    'Compromiso' => 'fa-handshake'
                ];
                foreach ($empresa['valores'] as $titulo => $descripcion): 
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="inline-block p-3 rounded-full bg-primary bg-opacity-10 mb-3">
                                <i class="fas <?= $iconos[$titulo] ?> fa-2x text-primary"></i>
                            </div>
                            <h3 class="card-title h5"><?= htmlspecialchars($titulo) ?></h3>
                            <p class="card-text"><?= htmlspecialchars($descripcion) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Clientes -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Nuestros Clientes</h2>
            <div class="row">
                <?php
                $logos = [
                    'Walmart' => 'https://upload.wikimedia.org/wikipedia/commons/c/ca/Walmart_logo.svg',
                    'Importex Green' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?auto=format&fit=crop&w=100&h=100&q=80',
                    'Banco Azteca' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Banco_Azteca_logo.svg',
                    'Henkel' => 'https://upload.wikimedia.org/wikipedia/commons/2/23/Henkel-Logo.svg',
                    'Otros clientes destacados' => 'https://images.unsplash.com/photo-1557426272-fc759fdf7a8d?auto=format&fit=crop&w=100&h=100&q=80'
                ];
                foreach ($empresa['clientes'] as $cliente): ?>
                <div class="col-md-2 col-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center justify-content-center p-3">
                            <img src="<?= $logos[$cliente] ?>" 
                                 alt="<?= htmlspecialchars($cliente) ?>" 
                                 class="img-fluid"
                                 style="max-height: 60px; filter: grayscale(100%) brightness(90%);">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Certificaciones -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Certificaciones y Alianzas</h2>
            <div class="row">
                <?php 
                $certificacionesImagenes = [
                    'Certificación en Seguridad' => 'https://images.unsplash.com/photo-1562813733-b31f71025d54?auto=format&fit=crop&w=300&h=150&q=80',
                    'Certificación en TI' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=300&h=150&q=80'
                ];
                foreach ($empresa['certificaciones'] as $certificacion): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="image-container" style="height: 200px; overflow: hidden;">
                            <img src="<?= $certificacionesImagenes[$certificacion['nombre']] ?>" 
                                 alt="<?= htmlspecialchars($certificacion['nombre']) ?>" 
                                 class="card-img-top"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title h5"><?= htmlspecialchars($certificacion['nombre']) ?></h3>
                            <p class="card-text"><?= htmlspecialchars($certificacion['descripcion']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-gradient-primary text-black py-5">
        <div class="container text-center">
            <h2 class="mb-4">¿Listo para comenzar?</h2>
            <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita.</p>
            <a href="<?php echo SITE_URL; ?>/contacto" 
               class="btn btn-light btn-lg shadow">
                <i class="fas fa-envelope me-2"></i>
                Contáctanos
            </a>
        </div>
    </section>
</div> 