<?php

class ServicioController {
    private $servicioModel;
    private $view;

    public function __construct() {
        $this->servicioModel = new ServicioModel();
        $this->view = new View();
    }

    public function index() {
        // Verificar autenticación
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $per_page = 10;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        // Obtener servicios paginados
        $servicios = $this->servicioModel->getAll($page, $per_page, $search);
        $total = $this->servicioModel->getTotal($search);
        $total_pages = ceil($total / $per_page);

        // Calcular rangos para la paginación
        $start_item = ($page - 1) * $per_page + 1;
        $end_item = min($page * $per_page, $total);

        $this->view->render('admin/servicios/index', [
            'servicios' => $servicios,
            'current_page' => $page,
            'total_pages' => $total_pages,
            'total_items' => $total,
            'start_item' => $start_item,
            'end_item' => $end_item,
            'search' => $search
        ]);
    }

    public function create() {
        // Verificar autenticación
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }

        $this->view->render('admin/servicios/form');
    }

    public function store() {
        // Verificar autenticación
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }

        // Validar datos
        $errors = [];
        $data = [
            'titulo' => trim($_POST['titulo'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'icono' => trim($_POST['icono'] ?? ''),
            'estado' => $_POST['estado'] ?? 'inactivo',
            'orden' => (int)($_POST['orden'] ?? 1),
            'caracteristicas' => $_POST['caracteristicas'] ?? []
        ];

        if (empty($data['titulo'])) {
            $errors[] = 'El título es requerido';
        }

        if (empty($data['descripcion'])) {
            $errors[] = 'La descripción es requerida';
        }

        if (empty($data['icono'])) {
            $errors[] = 'El icono es requerido';
        }

        // Procesar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $upload = $this->handleImageUpload($_FILES['imagen']);
            if (isset($upload['error'])) {
                $errors[] = $upload['error'];
            } else {
                $data['imagen'] = $upload['path'];
            }
        }

        if (empty($errors)) {
            // Guardar servicio
            $success = $this->servicioModel->create($data);
            if ($success) {
                $_SESSION['flash_message'] = 'Servicio creado exitosamente';
                $_SESSION['flash_type'] = 'success';
                header('Location: /admin/servicios');
                exit;
            } else {
                $errors[] = 'Error al crear el servicio';
            }
        }

        // Si hay errores, mostrar el formulario nuevamente
        $_SESSION['flash_message'] = implode('<br>', $errors);
        $_SESSION['flash_type'] = 'error';
        $this->view->render('admin/servicios/form', ['servicio' => $data]);
    }

    public function edit($id) {
        // Verificar autenticación
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }

        $servicio = $this->servicioModel->getById($id);
        if (!$servicio) {
            $_SESSION['flash_message'] = 'Servicio no encontrado';
            $_SESSION['flash_type'] = 'error';
            header('Location: /admin/servicios');
            exit;
        }

        $this->view->render('admin/servicios/form', ['servicio' => $servicio]);
    }

    public function update($id) {
        // Verificar autenticación
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }

        // Validar datos
        $errors = [];
        $data = [
            'id' => $id,
            'titulo' => trim($_POST['titulo'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'icono' => trim($_POST['icono'] ?? ''),
            'estado' => $_POST['estado'] ?? 'inactivo',
            'orden' => (int)($_POST['orden'] ?? 1),
            'caracteristicas' => $_POST['caracteristicas'] ?? []
        ];

        if (empty($data['titulo'])) {
            $errors[] = 'El título es requerido';
        }

        if (empty($data['descripcion'])) {
            $errors[] = 'La descripción es requerida';
        }

        if (empty($data['icono'])) {
            $errors[] = 'El icono es requerido';
        }

        // Procesar imagen si se subió una nueva
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $upload = $this->handleImageUpload($_FILES['imagen']);
            if (isset($upload['error'])) {
                $errors[] = $upload['error'];
            } else {
                $data['imagen'] = $upload['path'];
            }
        }

        if (empty($errors)) {
            // Actualizar servicio
            $success = $this->servicioModel->update($data);
            if ($success) {
                $_SESSION['flash_message'] = 'Servicio actualizado exitosamente';
                $_SESSION['flash_type'] = 'success';
                header('Location: /admin/servicios');
                exit;
            } else {
                $errors[] = 'Error al actualizar el servicio';
            }
        }

        // Si hay errores, mostrar el formulario nuevamente
        $_SESSION['flash_message'] = implode('<br>', $errors);
        $_SESSION['flash_type'] = 'error';
        $this->view->render('admin/servicios/form', ['servicio' => $data]);
    }

    public function delete($id) {
        // Verificar autenticación
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }

        $success = $this->servicioModel->delete($id);
        if ($success) {
            $_SESSION['flash_message'] = 'Servicio eliminado exitosamente';
            $_SESSION['flash_type'] = 'success';
        } else {
            $_SESSION['flash_message'] = 'Error al eliminar el servicio';
            $_SESSION['flash_type'] = 'error';
        }

        header('Location: /admin/servicios');
        exit;
    }

    private function handleImageUpload($file) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowed_types)) {
            return ['error' => 'Tipo de archivo no permitido. Solo se aceptan JPG, PNG y GIF.'];
        }

        if ($file['size'] > $max_size) {
            return ['error' => 'El archivo es demasiado grande. El tamaño máximo es 5MB.'];
        }

        $upload_dir = 'public/uploads/servicios/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $filename = uniqid() . '_' . basename($file['name']);
        $target_path = $upload_dir . $filename;

        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return ['path' => '/' . $target_path];
        }

        return ['error' => 'Error al subir el archivo'];
    }
} 