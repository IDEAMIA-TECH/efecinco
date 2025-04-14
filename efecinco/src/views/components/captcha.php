<?php
session_start();

// Generar un número aleatorio de 6 dígitos
$captcha = rand(100000, 999999);
$_SESSION['captcha'] = $captcha;
?>

<div class="mb-4">
    <label for="captcha" class="block text-sm font-medium text-gray-700 mb-2">
        Código de verificación
    </label>
    <div class="flex items-center space-x-4">
        <div class="flex-1">
            <input type="text" 
                   id="captcha" 
                   name="captcha" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>
        <div class="flex-shrink-0">
            <div class="bg-gray-100 p-2 rounded-md text-center font-mono text-lg">
                <?php echo $captcha; ?>
            </div>
        </div>
    </div>
    <p class="mt-1 text-sm text-gray-500">
        Por favor ingrese el código que ve en la imagen
    </p>
</div> 