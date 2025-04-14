<?php

class AboutController extends BaseController {
    public function index() {
        try {
            // Obtener información de la empresa desde la tabla de configuración
            $stmt = $this->db->query("SELECT * FROM configuracion WHERE clave IN ('mision', 'vision', 'historia', 'valores')");
            $config = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $config[$row['clave']] = $row['valor'];
            }

            // Obtener clientes destacados
            $stmt = $this->db->query("SELECT * FROM proyectos WHERE estado = 'activo' GROUP BY cliente ORDER BY fecha_proyecto DESC LIMIT 6");
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Renderizar la vista con los datos
            $data = [
                'mision' => $config['mision'] ?? '',
                'vision' => $config['vision'] ?? '',
                'historia' => $config['historia'] ?? '',
                'valores' => $config['valores'] ?? '',
                'clientes' => $clientes,
                'pageTitle' => '¿Quiénes Somos? - ' . SITE_NAME
            ];

            echo $this->render('about/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->redirect('/error');
        }
    }
} 