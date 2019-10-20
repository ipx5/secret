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
    public $config = false;
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
        autoloadRun();
//        Logger::$PATH = dirname(__FILE__);
//        $str = 'start_app';
//        Logger::getLogger('start_app') -> log($str);
        $this->config = $config;
        $this-> acceptCookie = 1;
        $this-> request =  new Request;
        $this-> user = new user;
//        $token =sha1(time().random_int(0, PHP_INT_MAX));
////        for(;;){
////            $check = $this-> db -> queryBuilder('select')-> select('id')-> from('users')-> where(['token'=> $token])->query();
////            if (empty($check)){
////                break;
////            }
////        }
//        setcookie('token', $token, time()+365*86400, '/', 'secret.com' ,false, true);
//        print_r($_COOKIE);
//        die();
        $this-> response =  new Response;
//        Logger::getLogger('start_app') -> log('success start');
//        $this -> response -> setHeader('Access-Control-Allow-Origin: *');

        try {
            $this-> request-> run();
        } catch (HttpException $e) {
            $e-> sendHttpState();
        } catch (DbException $e) {
            //TODO
            $e-> sendHttpState();
        } finally {
            $this-> response-> render();
        }
    }

    public function printTest($value) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }


}