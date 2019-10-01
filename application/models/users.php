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
    public function userRegister() {
        return $this -> db-> queryBuilder('select')-> select('*')-> from('users')-> where(['!', 'sub_token' => ''])-> query();
    }
    
    public function createUser($user){
        if ($user->password != $user->repassword){
            throw new Exception('Passwords do not match');
        }
        $checkEmail = $this-> db-> queryBuilder('select')-> select('id')-> from('users')-> where(['email'=> $user->email])-> query();
        if( !empty($checkEmail)){
            throw new Exception("This email already exist");
        }
        $checkUsername = $this-> db-> queryBuilder('select')-> select('id')-> from('users')-> where(['username'=> $user->username])-> query();
        if( !empty($checkUsername)){
            throw new Exception("This username already exist");
        }
        unset($user->repassword);
        $salt = md5(time() + random_int(0, PHP_INT_MAX));
        $user->password= sha1($user->password.$salt);
        $user->salt = $salt;
        $user->status = 0;
        $subtoken = sha1(time()+random_int(0, PHP_INT_MAX));
        $user->sub_token = $subtoken;
        $this-> db-> queryBuilder('insert')
        -> insert('users')
        -> columns(['email','username','password','salt','status','sub_token'])
        -> values([$user->email,$user->username,$user->password,$user->salt,$user->status,$user->sub_token])
        -> query();
    }

    
}