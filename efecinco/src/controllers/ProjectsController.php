<?php
namespace controllers;

use models\Project;
use Exception;

class ProjectsController extends BaseController {
    private $projectModel;
    
    public function __construct() {
        parent::__construct();
        $this->projectModel = new Project($this->db);
    }
    
    public function index() {
        try {
            $proyectos = $this->projectModel->getAllActiveProjects();
            
            $data = [
                'proyectos' => $proyectos,
                'pageTitle' => 'Nuestros Proyectos - ' . SITE_NAME
            ];
            
            echo $this->render('projects/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
    
    public function detalle($id) {
        try {
            $proyecto = $this->projectModel->getProjectById($id);
            
            if (!$proyecto) {
                $this->redirect('/proyectos');
            }
            
            $data = [
                'proyecto' => $proyecto,
                'pageTitle' => $proyecto['titulo'] . ' - ' . SITE_NAME
            ];
            
            echo $this->render('projects/detalle', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
} 