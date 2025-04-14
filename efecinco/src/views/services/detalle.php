<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background-image: url('<?php echo SITE_URL; ?>/uploads/<?php echo $servicio['imagen_fondo']; ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold"><?php echo $servicio['titulo']; ?></h1>
                <p class="lead"><?php echo $servicio['descripcion_corta']; ?></p>
            </div>
            <div class="col-md-4 text-center">
                <div class="service-icon-large">
                    <i class="<?php echo $servicio['icono']; ?>"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Details Section -->
<section class="service-details-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="service-content">
                    <h2 class="mb-4">Descripción del Servicio</h2>
                    <div class="service-description">
                        <?php echo $servicio['descripcion_completa']; ?>
                    </div>

                    <?php if (!empty($servicio['caracteristicas'])): ?>
                    <div class="service-features mt-5">
                        <h3 class="mb-4">Características Principales</h3>
                        <div class="row">
                            <?php foreach ($servicio['caracteristicas'] as $caracteristica): ?>
                            <div class="col-md-6 mb-3">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <?php echo $caracteristica; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-sidebar">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">¿Interesado en este servicio?</h4>
                            <p class="card-text">Contáctanos para más información o una cotización personalizada.</p>
                            <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary w-100">Solicitar Información</a>
                        </div>
                    </div>

                    <?php if (!empty($servicio['beneficios'])): ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Beneficios</h4>
                            <ul class="list-unstyled">
                                <?php foreach ($servicio['beneficios'] as $beneficio): ?>
                                <li class="mb-2">
                                    <i class="fas fa-check text-primary me-2"></i>
                                    <?php echo $beneficio; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects Section -->
<?php if (!empty($proyectos_relacionados)): ?>
<section class="related-projects-section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Proyectos Relacionados</h2>
        <div class="row">
            <?php foreach ($proyectos_relacionados as $proyecto): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $proyecto['imagen_principal']; ?>" class="card-img-top" alt="<?php echo $proyecto['titulo']; ?>">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $proyecto['titulo']; ?></h3>
                        <p class="card-text"><?php echo $proyecto['descripcion_corta']; ?></p>
                        <a href="<?php echo SITE_URL; ?>/proyectos/<?php echo $proyecto['id']; ?>" class="btn btn-primary">Ver Proyecto</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container text-center">
        <h2 class="mb-4">¿Listo para comenzar?</h2>
        <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita</p>
        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary btn-lg">Solicitar Consulta</a>
    </div>
</section>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 