<?php

class test extends model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
//        include_once 'framework/classes/ActiveRecord/ActiveRecord.php';
        include_once 'framework/classes/ActiveRecord/User1.php';
//        include_once 'framework/classes/ActiveRecord/Entity.php';
        include_once 'framework/classes/ActiveRecord/ActiveRecord.php';

        $config = [
            'users' => [
                'id' => 'int',
                'email' => 'str',
                'password' => 'str',
                'token' => 'str',
                'tmp_token' => 'str',
                'admin' => 'int',
                'role_id' => 'int',
                'status' => 'int'
            ],

            'role' => [
                'id' => 'int',
                'role' => 'str',
                'roles' => 'str'
            ]
        ];

        $AR = $this -> ActiveRecord($config);
//        print_r($users = $AR -> start('users') -> select(1, 1));
//        $role = $AR -> start('role');
//        print_r($role);
//        ActiveRecord::start($config) -> setTable('users');

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

//    $this -> db -> queryBuilder('update') -> table('users') -> set([['id' => 5], ['email' => 5]]) -> where([['id' => 8], ['AND'] , ['!' , 'email' => 'yandex']]) -> query();

//        $this -> db -> queryBuilder('insert') -> insert('users') -> columns(['id', 'email', 'age']) -> values([8, 'toxa@hacker.ua', 49]) -> query();
//        $this -> db -> queryBuilder('update') -> table('users') -> set([['id' => ':age'], ['email' => 'test@yandex.ru']]) -> where([['id' => 8], ['AND'], ['email' => ':id']]) -> query();
//            ['zhuravlev', '1231', '1213', '2'],
//            ['yandexKODW', 'wrqwe', 'wqdwqqwe2q', '1']
//        ]) -> query();
//        print_r($this -> db -> queryBuilder('select') -> select('*') -> from('roles_privileges')
//            -> join('join', 'privileges', ['privileges' => 'id', '=', 'role_privileges' => 'id'])
//            -> where(['r_p' => 'role_privileges'], ['r_p' => ['role_id' => '123321']]) -> query());

//        print_r($this -> db -> queryBuilder('select') -> select('*') -> from('roles_privileges')
//            -> join('join', 'privileges', ['privileges' => 'id', '=', 'role_privileges' => 'id'])
//            -> where([['!', 'id' => 5], ['AND'], ['!','email' => 'yandex'], ['OR'], ['I' => '1213']]) -> query());

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