<?php
$data = [
    'title' => 'Página no encontrada - ' . SITE_NAME,
    'description' => 'La página que buscas no existe o ha sido movida.'
];
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-1 text-muted">404</h1>
            <h2 class="mb-4">Página no encontrada</h2>
            <p class="lead mb-5">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            <a href="<?php echo SITE_URL; ?>" class="btn btn-primary">Volver al inicio</a>
        </div>
    </div>
</div> 