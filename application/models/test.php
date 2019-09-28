<?php

class test extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function insertFakeData() {
//        $this -> db -> queryBuilder('update') -> table('users') -> set(['email' => 'yandex', 'password' => 'yaaa'])-> query();
//        for ($i=0; $i<20; $i++) {
//            $this -> ActiveRecord('users');
//        }
//        $this -> db -> queryBuilder('select') -> select(['p.*']) ->
//        from(['roles_privileges' => 'rp']) ->
//        join('JOIN', ['privileges' => 'p'] , ['p.id' => 'rp.privilege_id']) ->
//        where(['rp.role_id' => 1]) -> query();
//        $this -> db -> queryBuilder('select') -> select(['a.id' => 'id_a','a.fruit' => 'fruit_a']) -> from(['basket_a' => 'a']) ->
//        join('FULL', ['basket_b' => 'b'], ['!', 'a.fruit' => 'b.fruit', 'OR' , 'a.bread' => 'b.bread']) -> where(['a.id' => ':b.id']) -> query();
//        ;
//        select p.* from roles_privileges as rp join privileges p on p.id=rp.privilege_id where rp.role_id=1;
//        $this -> db -> queryBuilder('seLect');
    }
}