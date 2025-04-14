<?php ob_start(); ?>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Testimonios de Nuestros Clientes</h1>
        <p class="text-xl text-gray-600">Descubre lo que nuestros clientes dicen sobre nuestros servicios</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($testimonios as $testimonio): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-2xl text-gray-600"><?= strtoupper(substr($testimonio['nombre_cliente'], 0, 1)) ?></span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($testimonio['nombre_cliente']) ?></h3>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($testimonio['cargo_empresa']) ?></p>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4"><?= htmlspecialchars($testimonio['contenido']) ?></p>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-yellow-400">
                                <?php for ($i = 0; $i < $testimonio['calificacion']; $i++): ?>
                                    ★
                                <?php endfor; ?>
                            </span>
                        </div>
                        <a href="/testimonios/<?= $testimonio['id'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                            Leer más
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php 
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 