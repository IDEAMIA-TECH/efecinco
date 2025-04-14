<?php
$content = ob_get_clean();
ob_start();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo isset($servicio) ? 'Editar Servicio' : 'Nuevo Servicio'; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="titulo" 
                                           name="titulo" 
                                           value="<?php echo isset($servicio) ? htmlspecialchars($servicio['titulo']) : ''; ?>" 
                                           required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" 
                                              id="descripcion" 
                                              name="descripcion" 
                                              rows="4" 
                                              required><?php echo isset($servicio) ? htmlspecialchars($servicio['descripcion']) : ''; ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="icono" class="form-label">Icono (Font Awesome)</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="icono" 
                                           name="icono" 
                                           value="<?php echo isset($servicio) ? htmlspecialchars($servicio['icono']) : ''; ?>" 
                                           required>
                                    <small class="form-text text-muted">
                                        Ejemplo: fas fa-camera
                                    </small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imagen_fondo" class="form-label">Imagen de Fondo</label>
                                    <input type="file" 
                                           class="form-control" 
                                           id="imagen_fondo" 
                                           name="imagen_fondo" 
                                           accept="image/*">
                                    <?php if (isset($servicio) && $servicio['imagen_fondo']): ?>
                                        <div class="mt-2">
                                            <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $servicio['imagen_fondo']; ?>" 
                                                 alt="Imagen actual" 
                                                 class="img-thumbnail" 
                                                 style="max-height: 200px;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="orden" class="form-label">Orden</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="orden" 
                                           name="orden" 
                                           value="<?php echo isset($servicio) ? $servicio['orden'] : '0'; ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" id="estado" name="estado">
                                        <option value="activo" <?php echo (isset($servicio) && $servicio['estado'] === 'activo') ? 'selected' : ''; ?>>
                                            Activo
                                        </option>
                                        <option value="inactivo" <?php echo (isset($servicio) && $servicio['estado'] === 'inactivo') ? 'selected' : ''; ?>>
                                            Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <?php echo isset($servicio) ? 'Actualizar' : 'Crear'; ?>
                            </button>
                            <a href="<?php echo SITE_URL; ?>/admin/servicios" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/admin.php';
?> 