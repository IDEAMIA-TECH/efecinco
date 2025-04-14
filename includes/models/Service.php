<?php
require_once __DIR__ . '/../db.php';

class Service {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Obtener todos los servicios
    public function getAllServices() {
        $this->db->query("SELECT * FROM services ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Obtener servicios destacados
    public function getFeaturedServices() {
        $this->db->query("SELECT * FROM services WHERE is_featured = 1 AND status = 'active' ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Obtener un servicio por ID
    public function getServiceById($id) {
        $this->db->query("SELECT * FROM services WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Obtener un servicio por slug
    public function getServiceBySlug($slug) {
        $this->db->query("SELECT * FROM services WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    // Crear un nuevo servicio
    public function createService($data) {
        $this->db->query("INSERT INTO services (title, slug, description, content, image, icon, is_featured, status) 
                         VALUES (:title, :slug, :description, :content, :image, :icon, :is_featured, :status)");
        
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':is_featured', $data['is_featured']);
        $this->db->bind(':status', $data['status']);

        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Actualizar un servicio
    public function updateService($data) {
        $this->db->query("UPDATE services SET 
                         title = :title,
                         slug = :slug,
                         description = :description,
                         content = :content,
                         image = :image,
                         icon = :icon,
                         is_featured = :is_featured,
                         status = :status
                         WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':is_featured', $data['is_featured']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    // Eliminar un servicio
    public function deleteService($id) {
        $this->db->query("DELETE FROM services WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Cambiar estado de un servicio
    public function toggleStatus($id) {
        $service = $this->getServiceById($id);
        $newStatus = $service['status'] == 'active' ? 'inactive' : 'active';
        
        $this->db->query("UPDATE services SET status = :status WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $newStatus);
        
        return $this->db->execute();
    }

    // Verificar si un slug ya existe
    public function slugExists($slug, $id = null) {
        $this->db->query("SELECT id FROM services WHERE slug = :slug" . ($id ? " AND id != :id" : ""));
        $this->db->bind(':slug', $slug);
        if($id) {
            $this->db->bind(':id', $id);
        }
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
} 