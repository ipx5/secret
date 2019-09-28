<?php

abstract class Model {
    protected $db = false;
    protected $currentTable = false;
    protected $config = false;
    protected $memcashe = false;
    protected $memcashedObj = false;
    public function __construct() {
        if ($this -> db === false) {
            $this -> db = new Pgsql(app::getInstance()->db['local']);
        }
        if (($this -> memcashedObj === false) && array_key_exists('memcached',app::getInstance()-> config)) {
            $this -> memcashedObj = new Memcached();
            $this -> memcashedObj -> addServer(app::getInstance()->memcached['host'],app::getInstance()->memcached['port']);
        }
    }

    public function ActiveRecord($tableName) {
        $config = [];
        $sql = "select column_name, data_type, character_maximum_length
        from INFORMATION_SCHEMA.COLUMNS where table_name = '$tableName' ";

        if ($this -> memcashedObj === false) {
            $result = $this -> db -> selectQuery($sql);
        } else {
            $result = $this -> memcashedObj -> get('getUsers');
            if (!$result) {
                $this -> memcashedObj -> set('getUsers', $this -> db -> selectQuery($sql));
            }
        }
        foreach ($result as $value) {
            $config[$value['column_name']] = ['type' => $value['data_type'], 'length' => $value['character_maximum_length']];
        }

        return ActiveRecord::setConfig($tableName, $config, $this -> db);
    }
}