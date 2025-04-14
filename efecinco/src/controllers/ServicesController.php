<?php

class ServicesController extends BaseController {
    private $serviceModel;
    
    public function __construct() {
        parent::__construct();
        $this->serviceModel = new Service($this->db);
    }
    
    public function index() {
        try {
            // Obtener servicios y planes usando el modelo
            $servicios = $this->serviceModel->getAllActiveServices();
            $planes_mantenimiento = $this->serviceModel->getMaintenancePlans();
            
            // Renderizar la vista con los datos
            $data = [
                'servicios' => $servicios,
                'planes_mantenimiento' => $planes_mantenimiento,
                'pageTitle' => 'Nuestros Servicios - ' . SITE_NAME
            ];
            
            echo $this->render('services/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
    
    public function detalle($id) {
        try {
            // Obtener el servicio usando el modelo
            $servicio = $this->serviceModel->getServiceById($id);
            
            if (!$servicio) {
                $this->redirect('/servicios');
            }
            
            // Obtener proyectos relacionados usando el modelo
            $proyectos = $this->serviceModel->getRelatedProjects($servicio['titulo']);
            
            // Renderizar la vista con los datos
            $data = [
                'servicio' => $servicio,
                'proyectos' => $proyectos,
                'pageTitle' => $servicio['titulo'] . ' - ' . SITE_NAME
            ];
            
            echo $this->render('services/detalle', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
} 