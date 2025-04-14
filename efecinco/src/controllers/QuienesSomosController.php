<?php
namespace controllers;

use models\ConfiguracionModel;

class QuienesSomosController extends BaseController {
    private $configModel;

    public function __construct() {
        parent::__construct();
        $this->configModel = new ConfiguracionModel($this->db);
    }

    public function index() {
        try {
            // Obtener configuración necesaria
            $config = $this->configModel->getByKeys([
                'sitio_titulo',
                'sitio_descripcion',
                'contacto_email',
                'contacto_telefono',
                'contacto_direccion',
                'redes_sociales'
            ]);

            // Datos de la empresa
            $empresa = [
                'mision' => 'Proporcionar soluciones tecnológicas innovadoras y confiables que impulsen el crecimiento y la seguridad de nuestros clientes.',
                'vision' => 'Ser líderes en soluciones tecnológicas y de seguridad, reconocidos por nuestra excelencia y compromiso con el cliente.',
                'valores' => [
                    'Excelencia' => 'Buscamos la perfección en cada proyecto y servicio que ofrecemos.',
                    'Innovación' => 'Nos mantenemos a la vanguardia tecnológica para ofrecer las mejores soluciones.',
                    'Integridad' => 'Actuamos con honestidad y transparencia en todas nuestras operaciones.',
                    'Compromiso' => 'Nos dedicamos al 100% a satisfacer las necesidades de nuestros clientes.'
                ],
                'linea_tiempo' => [
                    '2014' => 'Fundación de Efecinco',
                    '2015' => 'Primer proyecto de gran escala con Walmart',
                    '2016' => 'Expansión de servicios a nivel nacional',
                    '2017' => 'Certificación en sistemas de seguridad',
                    '2018' => 'Alianza estratégica con Henkel',
                    '2019' => 'Implementación de nuevas tecnologías',
                    '2020' => 'Adaptación a la nueva normalidad',
                    '2021' => 'Expansión de servicios de TI',
                    '2022' => 'Certificación en nuevas tecnologías',
                    '2023' => 'Implementación de IA en seguridad',
                    '2024' => 'Lanzamiento de nuevas soluciones'
                ],
                'clientes' => [
                    'Walmart',
                    'Importex Green',
                    'Banco Azteca',
                    'Henkel',
                    'Otros clientes destacados'
                ],
                'certificaciones' => [
                    [
                        'nombre' => 'Certificación en Seguridad',
                        'imagen' => '/assets/images/certificaciones/seguridad.jpg',
                        'descripcion' => 'Certificación en sistemas de seguridad avanzados'
                    ],
                    [
                        'nombre' => 'Certificación en TI',
                        'imagen' => '/assets/images/certificaciones/ti.jpg',
                        'descripcion' => 'Certificación en tecnologías de la información'
                    ]
                ]
            ];

            // Preparar los datos para la vista
            $data = [
                'title' => '¿Quiénes Somos? - ' . SITE_NAME,
                'description' => 'Conoce más sobre Efecinco, nuestra misión, visión y valores',
                'config' => $config,
                'empresa' => $empresa
            ];

            // Renderizar la vista
            $this->render('quienes-somos/index', $data);

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