<?php
// El contenido se capturará automáticamente por el buffer
?>

<style>
/* Estilos para la línea de tiempo */
.timeline {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 0;
}

.timeline::after {
    content: '';
    position: absolute;
    width: 2px;
    background: #e9ecef;
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -1px;
}

.timeline-item {
    padding: 10px 40px;
    position: relative;
    width: 50%;
    box-sizing: border-box;
}

.timeline-item-left {
    left: 0;
}

.timeline-item-right {
    left: 50%;
}

.timeline-content {
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: relative;
}

.timeline-dot {
    width: 20px;
    height: 20px;
    background: #0d6efd;
    border-radius: 50%;
    position: absolute;
    right: -10px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}

.timeline-item-right .timeline-dot {
    left: -10px;
}

.timeline-year {
    font-weight: bold;
    color: #0d6efd;
    margin-bottom: 10px;
}

.timeline-text {
    color: #6c757d;
}

@media (max-width: 768px) {
    .timeline::after {
        left: 31px;
    }

    .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
    }

    .timeline-item-right {
        left: 0;
    }

    .timeline-dot {
        left: 21px;
    }

    .timeline-item-right .timeline-dot {
        left: 21px;
    }
}
</style>

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

    <!-- Línea de Tiempo -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Nuestra Historia</h2>
            <div class="timeline">
                <?php $counter = 0; foreach ($empresa['linea_tiempo'] as $anio => $evento): $counter++; ?>
                <div class="timeline-item <?= $counter % 2 == 0 ? 'timeline-item-right' : 'timeline-item-left' ?>">
                    <div class="timeline-content">
                        <div class="timeline-year"><?= htmlspecialchars($anio) ?></div>
                        <div class="timeline-dot"></div>
                        <div class="timeline-text">
                            <p><?= htmlspecialchars($evento) ?></p>
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