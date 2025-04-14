<?php
$milestones = [
    [
        'year' => '2014',
        'title' => 'Fundación',
        'description' => 'Efecinco inicia operaciones con un equipo especializado en soluciones tecnológicas y de seguridad.'
    ],
    [
        'year' => '2016',
        'title' => 'Expansión de Servicios',
        'description' => 'Implementación de nuevos servicios en cableado estructurado y sistemas de seguridad.'
    ],
    [
        'year' => '2018',
        'title' => 'Alianzas Estratégicas',
        'description' => 'Establecimiento de alianzas con proveedores líderes en tecnología y seguridad.'
    ],
    [
        'year' => '2020',
        'title' => 'Crecimiento Sostenido',
        'description' => 'Consolidación como proveedor confiable para empresas líderes en el sector.'
    ],
    [
        'year' => '2024',
        'title' => 'Innovación Continua',
        'description' => 'Implementación de nuevas tecnologías y soluciones avanzadas para nuestros clientes.'
    ]
];
?>

<div class="relative container mx-auto px-6 py-12">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="h-full w-1 bg-blue-500"></div>
    </div>
    
    <div class="relative space-y-8">
        <?php foreach ($milestones as $milestone): ?>
        <div class="relative flex items-center">
            <div class="flex-shrink-0 w-24 h-24 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xl z-10">
                <?php echo $milestone['year']; ?>
            </div>
            <div class="ml-8 bg-white p-6 rounded-lg shadow-lg flex-1">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    <?php echo $milestone['title']; ?>
                </h3>
                <p class="text-gray-600">
                    <?php echo $milestone['description']; ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div> 