<?php
namespace core;

class View {
    public function render($view, $data = []) {
        // Extraer los datos para que estén disponibles en la vista
        extract($data);

        // Iniciar el buffer de salida
        ob_start();

        // Incluir la vista
        $viewPath = VIEWS_PATH . '/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new \Exception("Vista no encontrada: {$viewPath}");
        }

        // Obtener el contenido del buffer
        $content = ob_get_clean();

        // Incluir el layout principal
        require VIEWS_PATH . '/layouts/main.php';
    }
} 