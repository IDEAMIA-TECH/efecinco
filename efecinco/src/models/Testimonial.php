<?php

class Testimonial {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Obtiene todos los testimonios activos
     */
    public function getAllActiveTestimonials() {
        try {
            $stmt = $this->db->query("
                SELECT * FROM testimonios 
                WHERE estado = 'activo' 
                ORDER BY fecha_creacion DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * Obtiene un testimonio por su ID
     */
    public function getTestimonialById($id) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM testimonios 
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
     * Obtiene los últimos testimonios
     */
    public function getLatestTestimonials($limit = 6) {
        try {
            $stmt = $this->db->prepare("
                SELECT * FROM testimonios 
                WHERE estado = 'activo' 
                ORDER BY fecha_creacion DESC 
                LIMIT ?
            ");
            $stmt->execute([$limit]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    /**
     * Actualiza un testimonio
     */
    public function updateTestimonial($id, $data) {
        try {
            $sql = "UPDATE testimonios SET ";
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
     * Crea un nuevo testimonio
     */
    public function createTestimonial($data) {
        try {
            $columns = implode(", ", array_keys($data));
            $values = implode(", ", array_fill(0, count($data), "?"));
            
            $sql = "INSERT INTO testimonios ($columns) VALUES ($values)";
            $stmt = $this->db->prepare($sql);
            
            return $stmt->execute(array_values($data));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
} 