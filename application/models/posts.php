<?php 

class posts extends Model {

    public function postsList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('post')-> query();
    }

    public function getUser($id) {
        return $this -> db -> queryBuilder('select') -> select('*') -> from('post') -> where(['id' => $id]) -> query();
    }
}