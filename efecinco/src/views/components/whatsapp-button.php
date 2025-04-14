<?php
global $config;
if (!isset($config)) {
    $config = require_once CONFIG_PATH . '/config.php';
}
$whatsapp_number = $config['whatsapp_number'];
?>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000;">
    <a href="https://wa.me/<?php echo $whatsapp_number; ?>" 
       target="_blank" 
       rel="noopener noreferrer"
       class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white text-decoration-none" 
       style="width: 50px; height: 50px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: background-color 0.3s;">
        <i class="fab fa-whatsapp fa-2x"></i>
    </a>
</div> 