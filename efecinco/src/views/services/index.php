<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-center">Nuestros Servicios</h1>
        <p class="lead text-center">Soluciones tecnológicas y de seguridad para tu empresa</p>
    </div>
</section>

<!-- Servicios Section -->
<section class="services-section py-5">
    <div class="container">
        <div class="row">
            <?php foreach ($servicios as $servicio): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 service-card">
                    <div class="card-img-top" style="background-image: url('<?php echo SITE_URL; ?>/uploads/<?php echo $servicio['imagen_fondo']; ?>');">
                        <div class="service-icon">
                            <i class="<?php echo $servicio['icono']; ?>"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $servicio['titulo']; ?></h3>
                        <p class="card-text"><?php echo $servicio['descripcion']; ?></p>
                        <a href="<?php echo SITE_URL; ?>/servicios/<?php echo $servicio['id']; ?>" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Planes de Mantenimiento Section -->
<?php if (!empty($planes_mantenimiento)): ?>
<section class="maintenance-plans-section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Planes de Mantenimiento</h2>
        <div class="row">
            <?php foreach ($planes_mantenimiento as $plan): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0"><?php echo $plan['nombre']; ?></h3>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center mb-4"><?php echo $plan['precio']; ?></h4>
                        <ul class="list-unstyled">
                            <?php foreach ($plan['caracteristicas'] as $caracteristica): ?>
                            <li class="mb-2">
                                <i class="fas fa-check text-primary me-2"></i>
                                <?php echo $caracteristica; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary">Solicitar Información</a>
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
        <h2 class="mb-4">¿Necesitas un servicio personalizado?</h2>
        <p class="lead mb-4">Contáctanos para una solución a medida para tu empresa</p>
        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary btn-lg">Contáctanos</a>
    </div>
</section>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 