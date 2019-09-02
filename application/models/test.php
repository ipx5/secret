<?php

class test extends model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
        include_once 'framework/classes/ActiveRecord/User.php';
        $user2 = User::newEmptyInstance();
//        $user2 -> setEmail('admo@yandex.ru');
//        $user2 -> setSalt('fwfwfw');
//        $user2 -> save();
//        $user2 -> setEmail('vlad@yandex.ru');
//        $user2 -> save();
//        User::_delete([412, 413]);
//        $this -> db -> queryBuilder('delete') -> from('users') -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'password']) -> values([8, 'toxa@hacker.ua', 49]) -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['salt', 'email', 'password']) -> values([[12133, 'toxa@hacker.ua', 49], [467, 'modved@russia.ua', 45]]) -> query();
        $user2 -> select(8, 4);
//        print_r($this -> db -> queryBuilder('select')->select('*')->from('users')-> limit(20)->offset(1)->query());
    }
}