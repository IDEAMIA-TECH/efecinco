<?php

class HomeController extends BaseController {
    public function index() {
        try {
            // Obtener servicios activos
            $stmt = $this->db->query("SELECT * FROM servicios WHERE estado = 'activo' ORDER BY orden ASC");
            $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Obtener proyectos destacados
            $stmt = $this->db->query("SELECT * FROM proyectos WHERE estado = 'activo' ORDER BY fecha_proyecto DESC LIMIT 3");
            $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Obtener testimonios
            $stmt = $this->db->query("SELECT * FROM testimonios WHERE estado = 'activo' ORDER BY fecha_creacion DESC LIMIT 3");
            $testimonios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Renderizar la vista con los datos
            $data = [
                'servicios' => $servicios,
                'proyectos' => $proyectos,
                'testimonios' => $testimonios,
                'pageTitle' => 'Inicio - ' . SITE_NAME
            ];

            echo $this->render('home/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }

    public function error() {
        $data = [
            'pageTitle' => 'Error - ' . SITE_NAME,
            'message' => 'Ha ocurrido un error. Por favor, intente más tarde.'
        ];
        echo $this->render('error', $data);
    }
} 