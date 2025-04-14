<?php
$clients = [
    [
        'name' => 'Walmart',
        'logo' => '/assets/images/clients/walmart.png',
        'alt' => 'Walmart Logo'
    ],
    [
        'name' => 'Importex Green',
        'logo' => '/assets/images/clients/importex.png',
        'alt' => 'Importex Green Logo'
    ],
    [
        'name' => 'Banco Azteca',
        'logo' => '/assets/images/clients/banco-azteca.png',
        'alt' => 'Banco Azteca Logo'
    ],
    [
        'name' => 'Henkel',
        'logo' => '/assets/images/clients/henkel.png',
        'alt' => 'Henkel Logo'
    ]
];
?>

<div class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
            Nuestros Clientes
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
            <?php foreach ($clients as $client): ?>
            <div class="transform hover:scale-105 transition-transform duration-300">
                <img 
                    src="<?php echo SITE_URL . $client['logo']; ?>" 
                    alt="<?php echo $client['alt']; ?>"
                    class="h-16 object-contain grayscale hover:grayscale-0 transition-all duration-300"
                    loading="lazy"
                >
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div> 