<?php

class test extends model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
//        $this -> db -> queryBuilder('delete') -> from('users') -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'password']) -> values([8, 'toxa@hacker.ua', 49]) -> query();
        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['salt', 'email', 'password']) -> values([[12133, 'toxa@hacker.ua', 49], [467, 'modved@russia.ua', 45]]) -> query();

        print_r($this -> db -> queryBuilder('select')->select(['id', 'email'])->from('users')->query());
    }
}