<?php
// Establecer el título de la página
$pageTitle = 'Página no encontrada';

// Incluir el header
include '../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-1 text-primary mb-4">404</h1>
            <h2 class="mb-4">Página no encontrada</h2>
            <p class="lead mb-5">Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="<?php echo SITE_URL; ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i> Volver al inicio
                </a>
                <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-envelope me-2"></i> Contactar soporte
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 