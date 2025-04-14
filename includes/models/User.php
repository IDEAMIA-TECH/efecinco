<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Registrar un nuevo usuario
    public function register($data) {
        $this->db->query('INSERT INTO users (username, email, password, name, role) VALUES (:username, :email, :password, :name, :role)');
        
        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':role', $data['role']);
        
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Iniciar sesión
    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username AND status = "active"');
        $this->db->bind(':username', $username);
        
        $row = $this->db->single();
        
        if ($row) {
            $hashedPassword = $row->password;
            if (password_verify($password, $hashedPassword)) {
                // Actualizar último inicio de sesión
                $this->updateLastLogin($row->id);
                return $row;
            }
        }
        
        return false;
    }
    
    // Actualizar último inicio de sesión
    private function updateLastLogin($id) {
        $this->db->query('UPDATE users SET last_login = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    
    // Obtener usuario por ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // Obtener todos los usuarios
    public function getAllUsers() {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
    
    // Actualizar usuario
    public function updateUser($data) {
        $this->db->query('UPDATE users SET name = :name, email = :email, role = :role, status = :status WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':status', $data['status']);
        
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Cambiar contraseña
    public function changePassword($id, $password) {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':password', $password);
        
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Eliminar usuario
    public function deleteUser($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Verificar si el email existe
    public function emailExists($email, $id = null) {
        $this->db->query('SELECT * FROM users WHERE email = :email' . ($id ? ' AND id != :id' : ''));
        $this->db->bind(':email', $email);
        if ($id) {
            $this->db->bind(':id', $id);
        }
        
        $row = $this->db->single();
        
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
    
    // Verificar si el username existe
    public function usernameExists($username, $id = null) {
        $this->db->query('SELECT * FROM users WHERE username = :username' . ($id ? ' AND id != :id' : ''));
        $this->db->bind(':username', $username);
        if ($id) {
            $this->db->bind(':id', $id);
        }
        
        $row = $this->db->single();
        
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
} 