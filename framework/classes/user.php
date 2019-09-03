<?php

session_start();
class user {
    protected $db = false;
    public $isUser= false;
    public function __construct(){
        $this-> db= new Pgsql(app::getInstance()-> db['local']);
        //debug($this-> db);
        if(!isset($this-> id)){
            if(isset($_COOKIE['token'])){
                $user= $this-> db-> queryBuilder('select')-> select('id, email, role_id, is_admin, reg_date, status')-> from('users')-> where('token=:token', [':token' => $_COOKIE['token']])-> query();
                if(empty($user)){
                    setcookie('token', '', time()-1);
                } else {
                    foreach ($user as $key => $value) {
                        $this-> key =$value;
                    }
                }
            }
        }
        if(isset($this-> id)){
            $this-> isUser = true;
        }
    }
    public function __get($name){
        return $_SESSION[$name] ?? false;
    }
    public function __set($name, $value){
        if(is_array($value)){
            $_SESSION[$name]= array_merge((array) ($_SESSION[$name] ?? []), $value);
        } else {
            $_SESSION[$name] = $value;
        }
    }
    public function __isset($name){
        return isset($_SESSION[$name]);
    }
    public function __unset($name){
        unset($_SESSION[$name]);
    }
    public function registration($user){
        if ($user['password'] != $user['repassword']){
            throw new Exception('Passwords do not match');
        }
        $check = $this-> db-> queryBuilder('select')-> select('id')-> from('users')-> where('email=:email', [':email'=> $user['email']])-> query();
        if( !empty($check)){
            throw new Exception("This email already exist");
        }
        unset($user[repassword]);
        $salt = md5(time() + random_int(0, PHP_INT_MAX));
        $user['password'] = sha1($user['password'].$salt);
        $user['salt'] = $salt;
        $user['reg_date'] = time();
        $user['status'] = 1;
        $subtoken = sha1(time()+random_int(0, PHP_INT_MAX));
        $user['sub_token'] = $subtoken;
        $this-> db-> queryBuilder('insert')-> insert('users')-> insertData($user)-> query();
        header('location:/user/register');
        //$link = 'http://localhost/user/authorization?token='.$subtoken;
    }
    public function authenticate($user){
        $checkUser = $this-> db-> queryBuilder('select')-> select('*')-> from('users')-> where('email=:email', [':email'=> $user['email']])-> query();
        if(empty($checkUser)){
            throw new Exception('Email '.$user['email']. 'is not found');
        }
        $checkUser = reset($checkUser);
        $hash = sha1($user['password'].$checkUser['salt']);
        if($hash != $checkUser['password']){
            throw new Exception('Password incorrect'); 
        }
        if($checkUser['status'] != 0){
            if(!isset($user['sub_token']) || $user['sub_token'] != $checkUser['sub_token']){
                throw new Exception('Invalid data for email confirmation');
            }
            $this-> db-> queryBuilder('update')-> update('users')-> updateData(['sub_token'=> '', 'status'=> 0])-> where('id=:id', [':id'=> $checkUser['id']])-> query();
        }
        unset($checkUser['password'], $checkUser['salt'], $checkUser['token'], $checkUser['sub_token']);
        return $checkUser;
    }
    public function authorization($user){
        for(;;){
            $token =sha1(time().random_int(0, PHP_INT_MAX));
            $check = $this-> db = queryBuilder('select')-> select('id')-> from('users')-> where('token=:token',[':token'=> $token])->query();
            if (empty($check)){
                break;
            }
        }
        setcookie('token', $token, time()+365*86400);
        $this-> db-> queryBuilder('update')-> update('users')->updateData(['token'=>$token])-> where('id=:id', [':id'=> $user['id']])-> query();
        foreach ($user as $key => $value) {
            $this-> $key = $value;
        }
    }
    public function logout(){
        $this-> db-> queryBuilder('update')-> update('users')-> updateData(['token'=> ''])-> where('id=:id', [':id'=> $this-> id])-> query();
        $_SESSION = [];
        setcookie('token', '', time()-1);
    }
}