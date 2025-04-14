<?php
namespace models;

use core\Model;

class Contact extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function guardarMensaje($datos) {
        try {
            $sql = "INSERT INTO contactos (
                nombre, 
                empresa, 
                email, 
                telefono, 
                mensaje, 
                fecha_creacion
            ) VALUES (
                :nombre,
                :empresa,
                :email,
                :telefono,
                :mensaje,
                NOW()
            )";

            $stmt = $this->db->prepare($sql);
            
            return $stmt->execute([
                ':nombre' => $datos['nombre'],
                ':empresa' => $datos['empresa'],
                ':email' => $datos['email'],
                ':telefono' => $datos['telefono'],
                ':mensaje' => $datos['mensaje']
            ]);

        } catch (\PDOException $e) {
            error_log('Error en Contact::guardarMensaje: ' . $e->getMessage());
            return false;
        }
    }
} 