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
}
