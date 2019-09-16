<?php

class request {

    public $isForm = false;
    public $request = [];
    public $controller = '';
    public $action = '';
    public $method;

    public function __construct() {

        $this -> request = $_REQUEST ?? [];
        $this -> controller = $this -> request['controller'] ?? '';
        $this -> action = $this -> request['action'] ?? '';
        $this -> isForm = isset($this -> request['send']);
        unset($this -> request['controller'], $this -> request['action'], $this->request['send']);

        $typeRequest = $this -> getTypeRequest();
        if ($typeRequest === 'api') {
            $this->requestForApi();
        }
    }

    public function requestForApi() {
        $router = new Router($this -> getUrl(), $this -> getMethod());
        include 'framework/API/Add.php';
    }

    public function server($key) {
        $value = $_SERVER[strtoupper($key)];
        return isset($value) ? $this -> clean($value) : $this -> clean($_SERVER);
    }

    public function getTypeRequest() {
        return explode('/', $_SERVER['REQUEST_URI'])[1];
    }

    public function getUrl() {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

}
