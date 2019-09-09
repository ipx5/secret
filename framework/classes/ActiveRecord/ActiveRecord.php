<?php

class ActiveRecord extends model {
    protected static $currentTable = [];
    private $columnsTable = [];

    public function __construct()
    {
    }

    public static function start($tableName, $params) {
        if (self::$currentTable === [] || !(self::$currentTable[$tableName])) {
            self::$currentTable[$tableName] = $params;
            print_r(self::$currentTable);
        }
    }
}
