<?php
namespace controllers;

class HomeController extends BaseController {
    public function index() {
        try {
            // Obtener datos para la página de inicio
            $data = [
                'title' => 'Inicio - Efecinco',
                'description' => 'Bienvenido a Efecinco, su socio en ingeniería y construcción',
                'hero' => [
                    'title' => 'Ingeniería y Construcción de Excelencia',
                    'subtitle' => 'Soluciones integrales para sus proyectos',
                    'cta_text' => 'Conozca Nuestros Servicios',
                    'cta_link' => '/servicios'
                ],
                'services' => [
                    [
                        'title' => 'Ingeniería Civil',
                        'description' => 'Diseño y construcción de obras civiles',
                        'icon' => 'fas fa-building'
                    ],
                    [
                        'title' => 'Arquitectura',
                        'description' => 'Diseño arquitectónico y planificación',
                        'icon' => 'fas fa-drafting-compass'
                    ],
                    [
                        'title' => 'Consultoría',
                        'description' => 'Asesoría técnica especializada',
                        'icon' => 'fas fa-chart-line'
                    ]
                ]
            ];

            // Renderizar la vista
            $this->render('home/index', $data);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->error();
        }
    }

    public function error() {
        $data = [
            'title' => 'Error - ' . SITE_NAME,
            'message' => 'Ha ocurrido un error. Por favor, intente más tarde.'
        ];
        $this->render('error', $data);
    }
} 