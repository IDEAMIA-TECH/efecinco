<?php
namespace core;

class Controller {
    protected $view;
    protected $model;

    public function __construct() {
        $this->view = new View();
    }

    protected function render($view, $data = []) {
        $this->view->render($view, $data);
    }

    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function getPost($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? $default;
    }

    protected function getGet($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? $default;
    }
} 