<?php ob_start(); ?>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-8">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-3xl text-gray-600"><?= strtoupper(substr($testimonio['nombre_cliente'], 0, 1)) ?></span>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($testimonio['nombre_cliente']) ?></h1>
                        <p class="text-gray-600"><?= htmlspecialchars($testimonio['cargo_empresa']) ?></p>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <span class="text-yellow-400 text-2xl">
                            <?php for ($i = 0; $i < $testimonio['calificacion']; $i++): ?>
                                ★
                            <?php endfor; ?>
                        </span>
                        <span class="ml-2 text-gray-600"><?= $testimonio['calificacion'] ?> estrellas</span>
                    </div>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed">
                            <?= nl2br(htmlspecialchars($testimonio['contenido'])) ?>
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Fecha</h3>
                            <p class="mt-1 text-gray-900"><?= date('d/m/Y', strtotime($testimonio['fecha_creacion'])) ?></p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Servicio</h3>
                            <p class="mt-1 text-gray-900"><?= htmlspecialchars($testimonio['servicio_relacionado']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="/testimonios" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                Volver a testimonios
            </a>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 