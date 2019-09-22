<?php

class users extends Model {
    public function usersList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('users')-> query();
    }
    public function getUserById($id){
        $user= $this-> db -> queryBuilder('select')-> select('*')-> from('users')-> where(['id' => $id])-> query();
        return count($user) ? reset($user) : [];
    }
    public function saveUser($user){
        $id=$user['id'];
        unset($user['id']);
        $user['is_admin'] = isset($user['is_admin']) ? 'true' : 'false';
        if($user['is_admin'] =='true'){
            $user['role_id'] = 0;
        }
        $this-> db-> queryBuilder('update')-> table('users')-> set(['role_id'=> $user])-> where(['id'=> $id])-> query();
    }
}