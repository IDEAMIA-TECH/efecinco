<?php ob_start(); ?>

<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                <?= isset($servicio) ? 'Editar Servicio' : 'Nuevo Servicio' ?>
            </h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <form action="<?= isset($servicio) ? '/admin/servicios/actualizar/' . $servicio['id'] : '/admin/servicios/guardar' ?>" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="titulo" id="titulo" required
                               value="<?= isset($servicio) ? htmlspecialchars($servicio['titulo']) : '' ?>"
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" required
                                  class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?= isset($servicio) ? htmlspecialchars($servicio['descripcion']) : '' ?></textarea>
                    </div>

                    <!-- Icono -->
                    <div>
                        <label for="icono" class="block text-sm font-medium text-gray-700">Icono (Font Awesome)</label>
                        <input type="text" name="icono" id="icono"
                               value="<?= isset($servicio) ? htmlspecialchars($servicio['icono']) : '' ?>"
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                               placeholder="Ej: fas fa-camera">
                        <p class="mt-1 text-sm text-gray-500">Usa clases de Font Awesome (ej: fas fa-camera)</p>
                    </div>

                    <!-- Imagen -->
                    <div>
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                        <?php if (isset($servicio) && $servicio['imagen']): ?>
                        <div class="mt-2">
                            <img src="<?= htmlspecialchars($servicio['imagen']) ?>" alt="Imagen actual" class="h-32 w-32 object-cover rounded">
                        </div>
                        <?php endif; ?>
                        <input type="file" name="imagen" id="imagen" accept="image/*"
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300">
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="estado" id="estado" required
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="activo" <?= isset($servicio) && $servicio['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                            <option value="inactivo" <?= isset($servicio) && $servicio['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>

                    <!-- Orden -->
                    <div>
                        <label for="orden" class="block text-sm font-medium text-gray-700">Orden de Visualización</label>
                        <input type="number" name="orden" id="orden" required min="1"
                               value="<?= isset($servicio) ? $servicio['orden'] : '1' ?>"
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <!-- Características -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Características</label>
                        <div id="caracteristicas-container" class="mt-2 space-y-2">
                            <?php if (isset($servicio) && !empty($servicio['caracteristicas'])): ?>
                                <?php foreach (json_decode($servicio['caracteristicas'], true) as $caracteristica): ?>
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="caracteristicas[]" value="<?= htmlspecialchars($caracteristica) ?>"
                                           class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <button type="button" class="text-red-600 hover:text-red-900" onclick="removeCaracteristica(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="caracteristicas[]"
                                           class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <button type="button" class="text-red-600 hover:text-red-900" onclick="removeCaracteristica(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" onclick="addCaracteristica()" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                            <i class="fas fa-plus mr-1"></i>
                            Agregar Característica
                        </button>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="/admin/servicios" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <?= isset($servicio) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function addCaracteristica() {
    const container = document.getElementById('caracteristicas-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" name="caracteristicas[]"
               class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        <button type="button" class="text-red-600 hover:text-red-900" onclick="removeCaracteristica(this)">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeCaracteristica(button) {
    button.parentElement.remove();
}
</script>

<?php 
$content = ob_get_clean();
include VIEWS_PATH . '/admin/layout.php';
?> 