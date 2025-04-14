<?php
require_once '../../../includes/config.php';
require_once '../../../includes/functions.php';
require_once '../../../includes/models/Service.php';

// Verificar si el usuario está logueado
if (!isLoggedIn()) {
    redirect('admin/login.php');
}

$service = new Service();
$message = '';

// Procesar formulario de creación/edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'title' => sanitize($_POST['title']),
        'slug' => createSlug($_POST['title']),
        'description' => sanitize($_POST['description']),
        'content' => $_POST['content'],
        'image' => '',
        'icon' => sanitize($_POST['icon']),
        'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
        'status' => sanitize($_POST['status'])
    ];

    // Manejar la subida de imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadResult = uploadFile($_FILES['image'], UPLOADS_PATH . '/services/');
        if ($uploadResult) {
            $data['image'] = basename($uploadResult);
        }
    }

    if (isset($_POST['id'])) {
        // Actualizar servicio existente
        $data['id'] = $_POST['id'];
        if ($service->updateService($data)) {
            $message = 'Servicio actualizado correctamente';
        } else {
            $message = 'Error al actualizar el servicio';
        }
    } else {
        // Crear nuevo servicio
        if ($service->createService($data)) {
            $message = 'Servicio creado correctamente';
        } else {
            $message = 'Error al crear el servicio';
        }
    }
}

// Obtener todos los servicios
$services = $service->getAllServices();

// Incluir la vista
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h2>Gestión de Servicios</h2>
    
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="edit.php" class="btn btn-primary">Nuevo Servicio</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Destacado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $s): ?>
                <tr>
                    <td><?php echo $s['id']; ?></td>
                    <td><?php echo $s['title']; ?></td>
                    <td>
                        <span class="badge <?php echo $s['status'] == 'active' ? 'bg-success' : 'bg-danger'; ?>">
                            <?php echo $s['status']; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($s['is_featured']): ?>
                            <span class="badge bg-warning">Destacado</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="delete.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        <a href="toggle_status.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-secondary">
                            <?php echo $s['status'] == 'active' ? 'Desactivar' : 'Activar'; ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../../includes/footer.php'; ?> 