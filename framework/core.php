<?php

spl_autoload_register('app::autoload');

class app {
    private function __construct() {

    }
    private function __clone() {}
    private function __wakeup() {}
    private static $instance = false;
    public static function getInstance() {
        if (self::$instance == false) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    protected $config;
    public function start($config) {
        $this->config = $config;
        $this -> init();
        new Users();
        try {
            $this -> runController(
                    (!empty($_REQUEST['controller']) ? $_REQUEST['controller'] : 'main'),
                    (!empty($_REQUEST['action']) ? $_REQUEST['action'] : 'page')
                    );
        } catch (httpException $e) {
            $e ->sendHttpState();
            echo $e ->getMessage();
            $this ->runController('error', 'notfound');
        } catch (dbException $e) {
            echo $e->getMessage();
        }
    }
    
    protected function runController($controller, $action) {
        $fname = 'controller' . ucfirst(strtolower(str_replace(['/', '.'], '', $controller)));
        
        if (!@include_once $this->paths['controllers'] . $fname . '.php') {
            throw new httpException(404, 'Controller file not found');
        }
        if (!class_exists($fname)) {
            throw new httpException(404, 'Controller class not found');
        }
        $aname = 'action' .ucfirst(strtolower($action));
        $controller = new $fname;
        $controller -> $aname();
    }
    public static function autoload($name) {
        include $name . '.php';
    }

    public function __get($name) {
        return $this -> config[$name];
    }
    private function init() {
        $basepath = get_include_path();
        $basepath .= PATH_SEPARATOR . CLASSES;
        set_include_path($basepath);
    }
}

