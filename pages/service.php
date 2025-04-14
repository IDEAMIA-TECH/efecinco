<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/models/Service.php';

// Obtener el slug del servicio de la URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (empty($slug)) {
    redirect('services.php');
}

$service = new Service();
$serviceData = $service->getServiceBySlug($slug);

if (!$serviceData || $serviceData['status'] != 'active') {
    redirect('services.php');
}

// Incluir el header
include '../includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1><?php echo $serviceData['title']; ?></h1>
            
            <?php if ($serviceData['image']): ?>
                <img src="<?php echo SITE_URL . '/uploads/services/' . $serviceData['image']; ?>" 
                     class="img-fluid mb-4" alt="<?php echo $serviceData['title']; ?>">
            <?php endif; ?>

            <div class="service-content">
                <?php echo $serviceData['content']; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <?php if ($serviceData['icon']): ?>
                        <i class="<?php echo $serviceData['icon']; ?> fa-3x mb-3"></i>
                    <?php endif; ?>
                    
                    <h3 class="card-title"><?php echo $serviceData['title']; ?></h3>
                    <p class="card-text"><?php echo $serviceData['description']; ?></p>
                    
                    <div class="mt-4">
                        <a href="<?php echo SITE_URL; ?>/contact.php" class="btn btn-primary btn-lg w-100">
                            Solicitar Información
                        </a>
                    </div>
                </div>
            </div>

            <!-- Otros servicios relacionados -->
            <?php
            $otherServices = $service->getAllServices();
            if (count($otherServices) > 1):
            ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title">Otros Servicios</h4>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($otherServices as $other): ?>
                                <?php if ($other['id'] != $serviceData['id'] && $other['status'] == 'active'): ?>
                                    <li class="list-group-item">
                                        <a href="<?php echo SITE_URL; ?>/service/<?php echo $other['slug']; ?>">
                                            <?php echo $other['title']; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 