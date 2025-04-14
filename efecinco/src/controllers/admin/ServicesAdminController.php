<?php

class ServicesAdminController extends BaseController {
    private $serviceModel;
    
    public function __construct() {
        parent::__construct();
        $this->serviceModel = new Service($this->db);
        $this->checkAdminAccess();
    }
    
    public function index() {
        try {
            $servicios = $this->serviceModel->getAllActiveServices();
            
            $data = [
                'servicios' => $servicios,
                'pageTitle' => 'Administrar Servicios - ' . SITE_NAME
            ];
            
            echo $this->render('admin/services/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/admin/error');
        }
    }
    
    public function crear() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = $this->validateServiceData($_POST);
                
                if ($this->serviceModel->createService($data)) {
                    $_SESSION['success_message'] = 'Servicio creado exitosamente';
                    $this->redirect('/admin/servicios');
                } else {
                    $_SESSION['error_message'] = 'Error al crear el servicio';
                }
            }
            
            $data = [
                'pageTitle' => 'Crear Servicio - ' . SITE_NAME
            ];
            
            echo $this->render('admin/services/crear', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/admin/error');
        }
    }
    
    public function editar($id) {
        try {
            $servicio = $this->serviceModel->getServiceById($id);
            
            if (!$servicio) {
                $this->redirect('/admin/servicios');
            }
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = $this->validateServiceData($_POST);
                
                if ($this->serviceModel->updateService($id, $data)) {
                    $_SESSION['success_message'] = 'Servicio actualizado exitosamente';
                    $this->redirect('/admin/servicios');
                } else {
                    $_SESSION['error_message'] = 'Error al actualizar el servicio';
                }
            }
            
            $data = [
                'servicio' => $servicio,
                'pageTitle' => 'Editar Servicio - ' . SITE_NAME
            ];
            
            echo $this->render('admin/services/editar', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/admin/error');
        }
    }
    
    public function eliminar($id) {
        try {
            if ($this->serviceModel->updateService($id, ['estado' => 'inactivo'])) {
                $_SESSION['success_message'] = 'Servicio eliminado exitosamente';
            } else {
                $_SESSION['error_message'] = 'Error al eliminar el servicio';
            }
            
            $this->redirect('/admin/servicios');
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/admin/error');
        }
    }
    
    private function validateServiceData($postData) {
        $requiredFields = ['titulo', 'descripcion', 'icono'];
        $data = [];
        
        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                throw new Exception("El campo $field es requerido");
            }
            $data[$field] = trim($postData[$field]);
        }
        
        // Campos opcionales
        $optionalFields = ['imagen_fondo', 'orden', 'estado'];
        foreach ($optionalFields as $field) {
            if (isset($postData[$field])) {
                $data[$field] = trim($postData[$field]);
            }
        }
        
        return $data;
    }
    
    private function checkAdminAccess() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
            $this->redirect('/admin/login');
        }
    }
} 