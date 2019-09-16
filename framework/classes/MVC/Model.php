<?php

abstract class Model {
    protected $db = false;
    protected $currentTable = false;
    protected $ActiveRecordInstance = false;
    public function __construct() {
        if ($this -> db == false) {
            $this -> db = new Pgsql(app::getInstance()->db['local']);
        }
    }

    public function ActiveRecord($config) {
        return ActiveRecord::getInstance($config);
    }
}