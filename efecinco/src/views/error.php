<?php
ob_start();
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 text-danger mb-4">Error</h1>
            <p class="lead"><?php echo $message ?? 'Ha ocurrido un error. Por favor, intente más tarde.'; ?></p>
            <a href="/" class="btn btn-primary mt-4">Volver al Inicio</a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
?> 