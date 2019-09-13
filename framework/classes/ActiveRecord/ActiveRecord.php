<?php

class ActiveRecord {
    protected $currentTable = '';
    protected $currentValue = [];
    protected $columnsTable = [];
    protected static $config = false;
    protected static $instance = false;
    protected $table;

    private function __construct() {}
    private function __wakeup() {}
    private function __clone(){}

    public static function getInstance($config) {
        if (self::$instance === false) {
            self::$instance = new self();
        }
        if (!empty($config)) {
            self::$config = $config;
        }
        return self::$instance;
    }

    public function start($tableName) {
        if ($tableName == $this -> currentTable) {
            return $this -> table;
        }
        $this -> currentTable = $tableName;
        $this -> columnsTable = [];
        foreach (self::$config[$tableName] as $key => $value) {
            $this -> columnsTable[$key] = $value;
        }

        include_once 'framework/classes/ActiveRecord/Entity.php';
        return $this-> table = new Entity($this -> currentTable, $this -> columnsTable);
    }
}
