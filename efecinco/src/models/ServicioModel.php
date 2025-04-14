<?php

class ServicioModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($page = 1, $per_page = 10, $search = '') {
        $offset = ($page - 1) * $per_page;
        $params = [];
        $where = '';

        if (!empty($search)) {
            $where = "WHERE titulo LIKE ? OR descripcion LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $query = "SELECT * FROM servicios $where ORDER BY orden ASC, fecha_creacion DESC LIMIT ? OFFSET ?";
        $params[] = $per_page;
        $params[] = $offset;

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotal($search = '') {
        $params = [];
        $where = '';

        if (!empty($search)) {
            $where = "WHERE titulo LIKE ? OR descripcion LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $query = "SELECT COUNT(*) as total FROM servicios $where";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getById($id) {
        $query = "SELECT * FROM servicios WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO servicios (titulo, descripcion, icono, imagen, estado, orden, caracteristicas, fecha_creacion) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $data['titulo'],
            $data['descripcion'],
            $data['icono'],
            $data['imagen'] ?? null,
            $data['estado'],
            $data['orden'],
            json_encode($data['caracteristicas'])
        ]);
    }

    public function update($data) {
        $query = "UPDATE servicios 
                 SET titulo = ?, descripcion = ?, icono = ?, estado = ?, orden = ?, caracteristicas = ?";
        $params = [
            $data['titulo'],
            $data['descripcion'],
            $data['icono'],
            $data['estado'],
            $data['orden'],
            json_encode($data['caracteristicas'])
        ];

        // Si hay una nueva imagen, agregarla a la consulta
        if (isset($data['imagen'])) {
            $query .= ", imagen = ?";
            $params[] = $data['imagen'];
        }

        $query .= " WHERE id = ?";
        $params[] = $data['id'];

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id) {
        // Primero obtener la información del servicio para eliminar la imagen
        $servicio = $this->getById($id);
        if ($servicio && $servicio['imagen']) {
            $image_path = $_SERVER['DOCUMENT_ROOT'] . $servicio['imagen'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $query = "DELETE FROM servicios WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
} 