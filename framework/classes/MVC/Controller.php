<?php

abstract class Controller {
    
    protected $models = [];
    protected $layout = 'main';
    protected $templateDir = '';

    public function __construct() {}
    
    protected function getModel($name) {
        if (!isset($this-> models[$name])) {
//            if (!@include app::getInstance()-> paths['models'] . $name . '.php'){
//                throw new DbException(404, 'Undefined model');
//            }
            $this-> models[$name] = new $name();
        }
        return $this-> models[$name];
    }

    protected function renderLayout($params =[]) {
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

    public function responseSetHeader($header) {
        app::getInstance() -> response -> setHeader($header);
    }

    public function getRequest() {
        return app::getInstance() -> request;
    }

    public function getUser() {
        return app::getInstance() -> user;
    }

    public function responseSetContent($content) {
        app::getInstance() -> response->setContent($content);
    }

    public function responseSendStatus($status) {
        app::getInstance()-> response->sendStatus($status);
    }

    public function responeSendHtml($page) {
        app::getInstance() -> response -> setHtml($this -> renderLayout($page));
    }

    public function requestGetContent(){
        return app::getInstance() -> request-> getContent();
    }
}