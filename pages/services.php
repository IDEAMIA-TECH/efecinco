<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/models/Service.php';

$service = new Service();
$services = $service->getAllServices();
$featuredServices = $service->getFeaturedServices();

// Incluir el header
include '../includes/header.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-5">Nuestros Servicios</h1>

    <?php if ($featuredServices): ?>
        <div class="row mb-5">
            <h2 class="text-center mb-4">Servicios Destacados</h2>
            <?php foreach ($featuredServices as $service): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if ($service['image']): ?>
                            <img src="<?php echo SITE_URL . '/uploads/services/' . $service['image']; ?>" 
                                 class="card-img-top" alt="<?php echo $service['title']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if ($service['icon']): ?>
                                <i class="<?php echo $service['icon']; ?> fa-2x mb-3"></i>
                            <?php endif; ?>
                            <h3 class="card-title"><?php echo $service['title']; ?></h3>
                            <p class="card-text"><?php echo $service['description']; ?></p>
                            <a href="<?php echo SITE_URL; ?>/service/<?php echo $service['slug']; ?>" 
                               class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <h2 class="text-center mb-4">Todos Nuestros Servicios</h2>
        <?php foreach ($services as $service): ?>
            <?php if ($service['status'] == 'active'): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if ($service['image']): ?>
                            <img src="<?php echo SITE_URL . '/uploads/services/' . $service['image']; ?>" 
                                 class="card-img-top" alt="<?php echo $service['title']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if ($service['icon']): ?>
                                <i class="<?php echo $service['icon']; ?> fa-2x mb-3"></i>
                            <?php endif; ?>
                            <h3 class="card-title"><?php echo $service['title']; ?></h3>
                            <p class="card-text"><?php echo $service['description']; ?></p>
                            <a href="<?php echo SITE_URL; ?>/service/<?php echo $service['slug']; ?>" 
                               class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 