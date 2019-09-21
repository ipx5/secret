<?php


class request {

    public $isForm = false;
    public $request = [];
    public $controller = '';
    public $action = '';

    public function __construct() {
        $this -> request = $_REQUEST ?? [];
        $this -> controller = $this -> request['controller'] ?? '';
        $this -> action = $this -> request['action'] ?? '';
        $this -> isForm = isset($this -> request['send']);
        unset($this -> request['controller'], $this -> request['action'], $this->request['send']);
    }

    public function run() {
        $router = new Router($this -> getUrl(), $this -> getMethod());
        new Routes($router);
        $router -> run();
    }

    public function getUrl() {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
}
