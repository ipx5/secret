<?php

class test extends model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
        include_once 'framework/classes/ActiveRecord/ActiveRecord.php';
        include_once 'framework/classes/ActiveRecord/User1.php';


//        $this -> db -> queryBuilder('update') -> table('users') ->
//        set(['email' => 'vovaYa', 'token' => 'tokenTEST', 'tmp_token' => 'tmp_tokenTEST']) ->
//        where([['id' => 445], ['OR'], ['id' => 444], ['OR'], ['id' => 446]])
//            -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['email', 'token', 'tmp_token', 'status']) ->
//        values([
//            'zhuravlev', '1231', '1213', '2'
//        ]) -> query();
//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['email', 'token', 'tmp_token', 'status']) ->
//        values([
//            ['zhuravlev', '1231', '1213', '2'],
//            ['yandexKODW', 'wrqwe', 'wqdwqqwe2q', '1']
//        ]) -> query();
        print_r($this -> db -> queryBuilder('select') -> select('*') -> from('roles_privileges')
            -> join('join', 'privileges', ['privileges' => 'id', '=', 'role_privileges' => 'id'])
            -> where(['r_p' => 'role_privileges'], ['r_p' => ['role_id' => '123321']]) -> query());

//            $sql = $this -> db -> queryBuilder('select') -> select('*') -> from('users') -> where([['id' => 400], ['OR'], ['email' => 'admo@yandex.ru']]) -> orderBy('status') -> query();
//            print_r($sql);
//        $a = $this -> db -> queryBuilder('update') -> table('users') ->
//        set(['email' => 'vovaYa', 'token' => 'tokenTEST', 'tmp_token' => 'tmp_tokenTEST']) ->
//        where([['id' => 445], ['OR'], ['id' => 444], ['OR'], ['id' => 446]])
//            -> returningColumn(['email', 'id']) -> query();
//        print_r($a);


//        $this -> db -> queryBuilder('update') ->
//        table('users') -> set(['email' => 'putin', 'token' => 'VV']) ->
//        where(['email' => 'vovaYa', 'AND', 'id' => 445])
//        -> query();
    }
}