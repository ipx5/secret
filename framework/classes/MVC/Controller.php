<?php

abstract class Controller {
    
    protected $models = [];
    protected $layout = 'main';
    protected $templateDir = '';
    public $response;

    public function __construct() {
        $this->response = app::getInstance()-> response ;
    }
    
    protected function getModel($name) {
        if (!isset($this-> models[$name])) {
            if (!@include app::getInstance()-> paths['models'] . $name . '.php'){
                throw new dbException('Undefine model');
            }
            $this-> models[$name] = new $name();
            // if (file_exists(app::getInstance()->paths['models'] . $name . '.php')) {
            //     include app::getInstance()->paths['models'] . $name . '.php';
            //     $this->models[$name] = new $name();
            // } else {
            //     throw new dbException('Undefined model');
            // }
        }
        return $this-> models[$name];
    }
    protected function renderLayout( $params =[]) {
        foreach ($params as $name => $value) {
            $$name = $value;
        }
        ob_start();
        include app::getInstance()->paths['layouts']. $this-> layout.'.php';
        return ob_get_clean();
    }
    protected function renderTemplate($name, $params = []) {
        foreach ($params as $var => $value) {
            $$var = $value;
        }
        ob_start();
        include app::getInstance()->paths['views'] .$this->templateDir.DS. $name . '.php';
        return ob_get_clean();
    }

    public function send($status = 200, $msg) {
        $this->response->setHeader(sprintf('HTTP/1.1 ' . $status . ' %s' , $this->response->getStatusCodeText($status)));
        $this->response->setContent($msg);
    }
}