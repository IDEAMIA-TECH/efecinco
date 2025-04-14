<?php

class Service {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Obtiene todos los servicios activos
     */
    public function getAllActiveServices() {
        try {
            $stmt = $this->db->query("
                SELECT * FROM servicios 
                WHERE estado = 'activo' 
                ORDER BY orden ASC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * Obtiene un servicio por su ID
     */
    public function getServiceById($id) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM servicios 
                WHERE id = ? AND estado = 'activo'
            ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
    
    /**
     * Obtiene los planes de mantenimiento
     */
    public function getMaintenancePlans() {
        try {
            $stmt = $this->db->query("
                SELECT valor FROM configuracion 
                WHERE clave = 'planes_mantenimiento'
            ");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? json_decode($result['valor'], true) : [];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * Obtiene proyectos relacionados con un servicio
     */
    public function getRelatedProjects($serviceTitle, $limit = 3) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM proyectos 
                WHERE tipo_solucion LIKE ? 
                AND estado = 'activo' 
                ORDER BY fecha_proyecto DESC 
                LIMIT ?
            ");
            $stmt->execute(['%' . $serviceTitle . '%', $limit]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * Actualiza un servicio
     */
    public function updateService($id, $data) {
        try {
            $sql = "UPDATE servicios SET ";
            $params = [];
            $updates = [];
            
            foreach ($data as $key => $value) {
                $updates[] = "$key = ?";
                $params[] = $value;
            }
            
            $sql .= implode(", ", $updates);
            $sql .= " WHERE id = ?";
            $params[] = $id;
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    /**
     * Crea un nuevo servicio
     */
    public function createService($data) {
        try {
            $columns = implode(", ", array_keys($data));
            $values = implode(", ", array_fill(0, count($data), "?"));
            
            $sql = "INSERT INTO servicios ($columns) VALUES ($values)";
            $stmt = $this->db->prepare($sql);
            
            return $stmt->execute(array_values($data));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
} 