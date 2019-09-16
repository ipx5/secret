<?php

//spl_autoload_register('app::autoload');
function debug ($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}
class app {
    // Singleton
    protected $config = false;
    public $request = false;
    public $response = false;
    public $user = false;
    public $acceptCookie = false;
    private static $instance = false;
    private function __wakeup() {}
    private function __clone() {}
    private function __construct() {}

    // Added properties in config
    public function __get($name) {
        return $this -> config[$name];
    }

    public static function getInstance() {
        if (self::$instance == false) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function start($config) {
        $this->config = $config;
        autoloadRun();
        //if(!empty($_COOKIE) || (bool) $this-> acceptCookie){
            $this-> acceptCookie = 1;
            $this-> user = new user;
            $this -> request =  new Request;
            $this -> response =  new Response;
        //} 
        //new Users();
        try {
            $this -> runController(
                    (!empty($_REQUEST['controller']) ? $_REQUEST['controller'] : 'main'),
                    (!empty($_REQUEST['action']) ? $_REQUEST['action'] : 'page')
                    );
        } catch (httpException $e) {
            $e ->sendHttpState();
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
}