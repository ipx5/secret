<?php

class Logger {
    public static $PATH;
    protected static $loggers = [];

    protected $name;
    protected $file;
    protected $fp;

    public function __construct($name, $file = null) {
        $this -> name = $name;
        $this -> file = $file;

        $this->open();
    }

    public function open() {
        if (self::$PATH === null) {
            return;
        }

        $this->fp=fopen($this->file === null ?
            self::$PATH . '/' . $this->name . '.log' :
            self::$PATH . '/' . $this->file, 'a+');
    }

    public static function getLogger($name = 'root', $file = null) {
        if (!isset(self::$loggers[$name])) {
            self::$loggers[$name] = new Logger($name, $file);
        }

        return self::$loggers[$name];
    }

    public function log($message) {
        if (!is_string($message)) {
            $this->logPrint($message);
            return;
        }

        $log = '';
        $log .= '['.date('D M d H:i:s Y',time()).'] ';
        if(func_num_args()>1){
            $params=func_get_args();

            $message=call_user_func_array('sprintf',$params);
        }

        $log.=$message;
        $log.="\n";
        $this->writeInfo($log);
    }

    public function logPrint($object) {
        ob_start();
        print_r($object);
        $obj = ob_get_clean();
        $this->log($obj);
    }

    public function writeInfo($log) {
        fwrite($this->fp, $log);
    }

    public function __destruct(){
        fclose($this->fp);
    }
}