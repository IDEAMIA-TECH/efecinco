<?php

class Project {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Obtiene todos los proyectos activos
     */
    public function getAllActiveProjects() {
        try {
            $stmt = $this->db->query("
                SELECT * FROM proyectos 
                WHERE estado = 'activo' 
                ORDER BY fecha_proyecto DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * Obtiene un proyecto por su ID
     */
    public function getProjectById($id) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM proyectos 
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
     * Obtiene proyectos relacionados con un servicio
     */
    public function getProjectsByService($serviceTitle, $limit = 3) {
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
     * Actualiza un proyecto
     */
    public function updateProject($id, $data) {
        try {
            $sql = "UPDATE proyectos SET ";
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
     * Crea un nuevo proyecto
     */
    public function createProject($data) {
        try {
            $columns = implode(", ", array_keys($data));
            $values = implode(", ", array_fill(0, count($data), "?"));
            
            $sql = "INSERT INTO proyectos ($columns) VALUES ($values)";
            $stmt = $this->db->prepare($sql);
            
            return $stmt->execute(array_values($data));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    /**
     * Obtiene los últimos proyectos
     */
    public function getLatestProjects($limit = 6) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM proyectos 
                WHERE estado = 'activo' 
                ORDER BY fecha_proyecto DESC 
                LIMIT ?
            ");
            $stmt->execute([$limit]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
} 