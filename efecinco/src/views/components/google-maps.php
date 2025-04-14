<?php
$config = require_once CONFIG_PATH . '/config.php';
$maps_embed = $config['maps_embed'];
?>

<div class="w-full h-96 rounded-lg overflow-hidden shadow-lg">
    <iframe 
        src="<?php echo htmlspecialchars($maps_embed); ?>" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
<?php else: ?>
<div class="w-full h-96 rounded-lg overflow-hidden shadow-lg bg-gray-100 flex items-center justify-center">
    <div class="text-center">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-gray-500">No se ha configurado el mapa</p>
    </div>
</div>
<?php endif; ?> 