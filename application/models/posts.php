<?php 

class posts extends Model {

    public function postsList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('posts')-> query();
    }
}