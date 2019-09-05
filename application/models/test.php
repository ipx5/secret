<?php

class test extends model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
        include_once 'framework/classes/ActiveRecord/User1.php';
        // $user = User1::newEmptyInstance()->setEmail();

//        print_r($this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where(
//            [['!', "id" => 8],['AND'],
//                ['!', "id" => 340], ['AND'],
//                ['!', 'email' => 'modved@russia.ua'], ['AND'],
//                ['!','email' => 'toxa@hacker.ua'], ['AND'],
//                ['!', 'email' => 'admo@yandex.ru']
//                ])->query());
////        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['email','salt']) -> values(['mvd@yandex.ru', 'mvd@yandex.ru']) -> query();
//        $user2 = User::newEmptyInstance() -> setSalt('token') -> setEmail('admo@yandex.ru') -> setId(1);
//        print_r($user2);
//        $this-> db-> queryBuilder('insert')
//            -> insert('users')
//            -> columns(['email','password','salt','status','tmp_token'])
//            -> values(['qwdwq','ewd','wedwe',1,1])
//            -> query();
//        $this -> db -> queryBuilder('update') -> table('users') -> set(['id' => 50000, 'email' => 'gosha'])->where(['!','id' => 444, 'OR', '!' , 'email' => 'mvd@yandex.ru'])-> query();
//        $user2 -> setSalt('token');
//        $user2 -> setTmp_token('token2323');
//        $user2 -> setId(13);
//        $aID = $user2 -> getEmail();
//        print_r($aID);//        print_r($set);
//        $user2 -> setEmail('admo@yandex.ru');//        pr//        print_r($set);int_r($set);
//        $user2 -> setSalt('fwfwfw');
//        $user2 -> save();
//        $user2 -> setEmail('vlad@yandex.ru');
//        $user2 -> save();
//        User::_delete([412, 413]);
//        $this -> db -> queryBuilder('delete') -> from('users') -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'password']) -> values([8, 'toxa@hacker.ua', 49]) -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['salt', 'email', 'password']) -> values([[12133, 'toxa@hacker.ua', 49], [467, 'modved@russia.ua', 45]]) -> query();
//        $user2 -> select(8, 4);
//        $query = $user2 -> select(10, 3);
//        print_r($query);
//        print_r($this -> db -> queryBuilder('select')->select('*')->from('users')-> limit(20)->offset(1)->query());
    }
}