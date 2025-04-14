<?php
namespace models;

class ConfiguracionModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByKeys($keys) {
        try {
            $placeholders = str_repeat('?,', count($keys) - 1) . '?';
            $sql = "SELECT clave, valor FROM configuracion WHERE clave IN ($placeholders)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($keys);
            
            $result = [];
            while ($row = $stmt->fetch()) {
                $result[$row['clave']] = $row['valor'];
            }
            
            return $result;
        } catch (\PDOException $e) {
            error_log("Error en ConfiguracionModel::getByKeys: " . $e->getMessage());
            return [];
        }
    }

    public function getAll() {
        try {
            $sql = "SELECT clave, valor FROM configuracion";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            $result = [];
            while ($row = $stmt->fetch()) {
                $result[$row['clave']] = $row['valor'];
            }
            
            return $result;
        } catch (\PDOException $e) {
            error_log("Error en ConfiguracionModel::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function update($key, $value) {
        try {
            $sql = "INSERT INTO configuracion (clave, valor) VALUES (?, ?) 
                    ON DUPLICATE KEY UPDATE valor = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$key, $value, $value]);
        } catch (\PDOException $e) {
            error_log("Error en ConfiguracionModel::update: " . $e->getMessage());
            return false;
        }
    }
} 