<?php

abstract class Model {
    protected $db = false;
    protected $currentTable = false;
    protected $config = false;
    public function __construct() {
        if ($this -> db == false) {
            $this -> db = new Pgsql(app::getInstance()->db['local']);
        }
    }

    public function ActiveRecord($tableName) {
        $config = [];
        $sql = "select column_name, data_type, character_maximum_length
        from INFORMATION_SCHEMA.COLUMNS where table_name = '$tableName' ";
        if ($this -> currentTable != $tableName) {
            $result = $this -> db -> selectQuery($sql);
        } else {
            $result = $this -> config;
        }
        foreach ($result as $value) {
            $config[$value['column_name']] = ['type' => $value['data_type'], 'length' => $value['character_maximum_length']];
        }

        return ActiveRecord::setConfig($tableName, $config, $this -> db);
    }
}