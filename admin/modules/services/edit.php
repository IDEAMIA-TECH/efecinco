<?php
require_once '../../../includes/config.php';
require_once '../../../includes/functions.php';
require_once '../../../includes/models/Service.php';

// Verificar si el usuario está logueado
if (!isLoggedIn()) {
    redirect('admin/login.php');
}

$service = new Service();
$serviceData = [
    'id' => '',
    'title' => '',
    'description' => '',
    'content' => '',
    'image' => '',
    'icon' => '',
    'is_featured' => 0,
    'status' => 'active'
];

// Si se está editando un servicio existente
if (isset($_GET['id'])) {
    $serviceData = $service->getServiceById($_GET['id']);
    if (!$serviceData) {
        redirect('index.php');
    }
}

// Incluir la vista
include '../../../includes/header.php';
?>

<div class="container mt-4">
    <h2><?php echo $serviceData['id'] ? 'Editar' : 'Nuevo'; ?> Servicio</h2>
    
    <form method="POST" enctype="multipart/form-data" class="mt-4">
        <?php if ($serviceData['id']): ?>
            <input type="hidden" name="id" value="<?php echo $serviceData['id']; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $serviceData['title']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción Corta</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $serviceData['description']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea class="form-control" id="content" name="content" rows="10" required><?php echo $serviceData['content']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <?php if ($serviceData['image']): ?>
                <div class="mb-2">
                    <img src="<?php echo SITE_URL . '/uploads/services/' . $serviceData['image']; ?>" alt="Imagen actual" style="max-width: 200px;">
                </div>
            <?php endif; ?>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Icono (Clase de Font Awesome)</label>
            <input type="text" class="form-control" id="icon" name="icon" value="<?php echo $serviceData['icon']; ?>" placeholder="Ej: fa-camera">
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" <?php echo $serviceData['is_featured'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="is_featured">
                    Servicio Destacado
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select" id="status" name="status">
                <option value="active" <?php echo $serviceData['status'] == 'active' ? 'selected' : ''; ?>>Activo</option>
                <option value="inactive" <?php echo $serviceData['status'] == 'inactive' ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    // Inicializar editor de texto enriquecido (si se usa)
    document.addEventListener('DOMContentLoaded', function() {
        // Aquí se puede inicializar un editor como TinyMCE o CKEditor
    });
</script>

<?php include '../../../includes/footer.php'; ?> 