<?php

class TestimonialsController extends BaseController {
    private $testimonialModel;
    
    public function __construct() {
        parent::__construct();
        $this->testimonialModel = new Testimonial($this->db);
    }
    
    public function index() {
        try {
            $testimonios = $this->testimonialModel->getAllActiveTestimonials();
            
            $data = [
                'testimonios' => $testimonios,
                'pageTitle' => 'Testimonios - ' . SITE_NAME
            ];
            
            echo $this->render('testimonials/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
    
    public function detalle($id) {
        try {
            $testimonio = $this->testimonialModel->getTestimonialById($id);
            
            if (!$testimonio) {
                $this->redirect('/testimonios');
            }
            
            $data = [
                'testimonio' => $testimonio,
                'pageTitle' => 'Testimonio de ' . $testimonio['nombre_cliente'] . ' - ' . SITE_NAME
            ];
            
            echo $this->render('testimonials/detalle', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
} 