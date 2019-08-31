<?php

class test extends model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
        print_r($this -> db -> queryBuilder('select')->select('*')->from('users')->query());
    }
}