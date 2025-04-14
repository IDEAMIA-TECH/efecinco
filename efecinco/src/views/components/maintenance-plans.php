<?php
$plans = [
    [
        'name' => 'Plan Básico',
        'price' => '$500.000',
        'period' => 'mensual',
        'features' => [
            'Monitoreo remoto 24/7',
            'Mantenimiento preventivo mensual',
            'Soporte técnico básico',
            'Reportes de estado semanales'
        ],
        'highlight' => false
    ],
    [
        'name' => 'Plan Profesional',
        'price' => '$800.000',
        'period' => 'mensual',
        'features' => [
            'Monitoreo remoto 24/7',
            'Mantenimiento preventivo semanal',
            'Soporte técnico prioritario',
            'Reportes de estado diarios',
            'Respaldo de datos',
            'Actualizaciones de software'
        ],
        'highlight' => true
    ],
    [
        'name' => 'Plan Empresarial',
        'price' => '$1.200.000',
        'period' => 'mensual',
        'features' => [
            'Monitoreo remoto 24/7',
            'Mantenimiento preventivo diario',
            'Soporte técnico dedicado',
            'Reportes de estado en tiempo real',
            'Respaldo de datos',
            'Actualizaciones de software',
            'Capacitación del personal',
            'Análisis de seguridad'
        ],
        'highlight' => false
    ]
];
?>

<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                Planes de Mantenimiento
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Ofrecemos planes de mantenimiento adaptados a las necesidades de tu empresa, 
                asegurando el óptimo funcionamiento de tus sistemas de seguridad y tecnología.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($plans as $plan): ?>
            <div class="relative <?php echo $plan['highlight'] ? 'transform scale-105' : ''; ?>">
                <?php if ($plan['highlight']): ?>
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                        Recomendado
                    </span>
                </div>
                <?php endif; ?>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden <?php echo $plan['highlight'] ? 'border-2 border-blue-500' : ''; ?>">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            <?php echo $plan['name']; ?>
                        </h3>
                        <div class="mb-4">
                            <span class="text-3xl font-bold text-blue-500">
                                <?php echo $plan['price']; ?>
                            </span>
                            <span class="text-gray-500">/<?php echo $plan['period']; ?></span>
                        </div>
                        
                        <ul class="space-y-3 mb-6">
                            <?php foreach ($plan['features'] as $feature): ?>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <?php echo $feature; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <a href="<?php echo SITE_URL; ?>/contacto" 
                           class="block w-full text-center bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
                            Contáctanos
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div> 