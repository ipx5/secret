<?php

abstract class controller {
    
    protected $models = [];
    protected $layout = 'main';
    protected $templateDir = 'template';

    public function __construct() {}
    
    protected function getModel($name) {
        if (!isset($this->models[$name])) {
            if (file_exists(app::getInstance()->paths['models'] . $name . '.php')) {
                include app::getInstance()->paths['models'] . $name . '.php';
                $this->models[$name] = new $name();
            } else {
                throw new dbException('Undefined model');
            }
        }
        return $this->models[$name];
    }
    
    protected function renderLayout($lay ,$params = []) {
        foreach ($params as $name => $value) {
            $$name = $value;
        }
        ob_start();
        include app::getInstance()->paths['layout']. $lay . '.php';
        return ob_get_clean();
    }

    protected function renderTemplate($name, $params = []) {
        foreach ($params as $var => $value) {
            $$var = $value;
        }
        ob_start();
        include app::getInstance()->paths['template'] . $name . '.php';
        return ob_get_clean();
    }
}
