<?php
$content = ob_get_clean();
ob_start();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Servicios</h3>
                    <a href="<?php echo SITE_URL; ?>/admin/servicios/crear" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Servicio
                    </a>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <?php 
                            echo $_SESSION['success_message'];
                            unset($_SESSION['success_message']);
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger">
                            <?php 
                            echo $_SESSION['error_message'];
                            unset($_SESSION['error_message']);
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Icono</th>
                                    <th>Orden</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($servicios as $servicio): ?>
                                <tr>
                                    <td><?php echo $servicio['id']; ?></td>
                                    <td><?php echo htmlspecialchars($servicio['titulo']); ?></td>
                                    <td>
                                        <i class="<?php echo htmlspecialchars($servicio['icono']); ?>"></i>
                                    </td>
                                    <td><?php echo $servicio['orden']; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $servicio['estado'] === 'activo' ? 'success' : 'danger'; ?>">
                                            <?php echo ucfirst($servicio['estado']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>/admin/servicios/editar/<?php echo $servicio['id']; ?>" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal<?php echo $servicio['id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        
                                        <!-- Modal de Confirmación -->
                                        <div class="modal fade" id="deleteModal<?php echo $servicio['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar el servicio "<?php echo htmlspecialchars($servicio['titulo']); ?>"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <a href="<?php echo SITE_URL; ?>/admin/servicios/eliminar/<?php echo $servicio['id']; ?>" 
                                                           class="btn btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/admin.php';
?> 