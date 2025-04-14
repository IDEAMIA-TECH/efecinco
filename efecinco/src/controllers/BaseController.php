<?php
namespace controllers;

use database\Database;

class BaseController {
    protected $db;
    protected $view;
    protected $config;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->config = require_once SRC_PATH . '/config/config.php';
    }

    protected function render($view, $data = []) {
        try {
            // Manejo seguro del buffer
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            
            // Obtener el contenido de la vista
            $viewFile = VIEWS_PATH . '/' . $view . '.php';
            if (!file_exists($viewFile)) {
                throw new \Exception("Vista no encontrada: $viewFile");
            }
            
            // Incluir la vista y obtener su contenido
            ob_start();
            $content = include $viewFile;
            
            // Si hay contenido en el buffer, usarlo
            if (ob_get_length() > 0) {
                $content = ob_get_clean();
            }
            
            // Iniciar un nuevo buffer para el layout
            ob_start();
            
            // Renderizar el layout con el contenido
            require_once VIEWS_PATH . '/layout/main.php';
            
            // Enviar todo el contenido
            ob_end_flush();
            
        } catch (\Exception $e) {
            // Limpiar cualquier buffer pendiente en caso de error
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            error_log($e->getMessage());
            throw $e;
        }
    }

    protected function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }

    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    protected function requireAuth() {
        if (!$this->isAuthenticated()) {
            $this->redirect('/admin/login');
        }
    }

    protected function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    protected function uploadFile($file, $allowedTypes = ALLOWED_FILE_TYPES, $maxSize = MAX_FILE_SIZE) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error uploading file');
        }

        if ($file['size'] > $maxSize) {
            throw new Exception('File too large');
        }

        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception('Invalid file type');
        }

        $fileName = uniqid() . '.' . $fileType;
        $uploadPath = UPLOAD_PATH . '/' . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new Exception('Error moving uploaded file');
        }

        return $fileName;
    }
} 