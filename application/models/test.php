<?php

class test extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
        $AR = $this -> ActiveRecord('roles');
        $result = $AR -> select(10, 0);
        print_r($result);
    }
}