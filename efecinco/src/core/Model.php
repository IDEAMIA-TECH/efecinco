<?php
namespace core;

class Model {
    protected $db;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->db = new \PDO($dsn, DB_USER, DB_PASS);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log('Error en Model::__construct: ' . $e->getMessage());
            throw new \Exception('Error al conectar con la base de datos');
        }
    }

    protected function query($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            error_log('Error en Model::query: ' . $e->getMessage());
            throw new \Exception('Error al ejecutar la consulta');
        }
    }

    protected function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    protected function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    protected function lastInsertId() {
        return $this->db->lastInsertId();
    }
} 