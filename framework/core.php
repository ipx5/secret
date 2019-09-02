<?php

spl_autoload_register('app::autoload');

class app {
    protected $config = false;
    public $request = false;
    public $user = false;
    public $acceptCookie = false;
    private static $instance = false;
    private function __wakeup() {}
    private function __clone() {}
    private function __construct() {
        self::init();
        $this-> request = new request;
    }

    public function __get($name) {
        return $this -> config[$name];
    }
    private function init() {
        $basepath = get_include_path();
        $basepath .= PATH_SEPARATOR . CLASSES . PATH_SEPARATOR . QB;
        set_include_path($basepath);
    }
    public static function autoload($name) {
        include $name . '.php';
    }
    public static function getInstance() {
        if (self::$instance == false) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function start($config) {
        $this->config = $config;
        $this -> init();
        //if(!empty($_COOKIE) || (bool) $this-> acceptCookie){
            $this-> acceptCookie = 1;
            $this-> user = new user;
        //} 
        //new Users();
        try {
            $this -> runController(
                    (!empty($_REQUEST['controller']) ? $_REQUEST['controller'] : 'main'),
                    (!empty($_REQUEST['action']) ? $_REQUEST['action'] : 'page')
                    );
        } catch (httpException $e) {
            $e ->sendHttpState();
            //echo $e ->getMessage();
            $this ->runController('error', 'notfound');
        } catch (dbException $e) {
            echo $e->getMessage();
            die();
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
    public function print_d($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}