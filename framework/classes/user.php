<?php


// statuses:
// 1-ok
// 0-register but not corfirmed
// 2-password is reseted
session_start();
class user {
    protected $db = false;
    public $isUser = false;

    public function __construct(){
        $this-> db= new Pgsql(app::getInstance()-> db['local']);
        if(!isset($this-> id) && isset($_COOKIE['token'])){
            $user = $this-> db-> queryBuilder('select')-> select('id, username, email, role_id, is_admin, reg_date, status')-> from('users')-> where(['token' => $_COOKIE['token']])-> query();
            $user = reset($user); //удаляю ключ из массива (метод php)
            if(empty($user)){
                setcookie('token', '', time()-1, '/');
            } else {
                foreach ($user as $key => $value) {
                    $this-> $key =$value;
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

    public function restore($data){
        if(empty($data['password'])){
            throw new Exception('Password is empty');
        }
        if(empty($data['repassword'])){
            throw new Exception('Password confirmation is empty');
        }
        if($data['password'] != $data['repassword']){
            throw new Exception('Password confirmation is fail');
        }
        if(empty($data['sub_token'])){
            throw new Exception('Resore token is fail');
        }
        $user = $this-> db-> queryBuilder('select')-> select('*')-> from('users')-> where(['sub_token' => $data['sub_token']])-> query();
        if(empty($user)){
            throw new Exception('Resore token is fail');
        }
        $user = reset($user);//удаляю ключ из массива (метод php)
        $salt = md5(time() + random_int(0, PHP_INT_MAX));
        $password= sha1($data['password'].$salt);
        $this-> db-> queryBuilder('update')-> table('users')-> set([['sub_token'=> ''], ['status'=> 0], ['password' => $password], ['salt' => $salt]])-> where(['id'=> $user])-> query();
    }

    public function reset($email){
        if(!email){
            throw new Exception('Email is empty');
        }
        $user = $this-> db-> queryBuilder('select')-> select('id')-> from('users')-> where(['email'=> $user['email']])-> query();
        if(empty($user)){
            throw new Exception('User with '.$email.' not registered');
        }
        $user = reset($user); //удаляю ключ из массива (метод php)
        $subtoken = sha1(time()+random_int(0, PHP_INT_MAX));
        $this-> db-> queryBuilder('update')-> table('users')-> set([['sub_token'=> $subtoken], ['status'=> 2], ['token' => '']])-> where(['id'=> $user['id']])-> query();
        $_SESSION = [];
        setcookie('token', '', time()-1, '/');
        //TODO отправить ссылку на емайл http://localhost/user/restore/?token=$subtoken
    }



    public function authenticate($user, $checkUser){
        $hash = sha1($user['password'] . $checkUser['salt']);

        if($hash != $checkUser['password']){
            throw new Exception('Password incorrect'); 
        }

        if($checkUser['status'] != 0){
            if(!isset($user['sub_token']) || $user['sub_token'] != $checkUser['sub_token']){
                throw new Exception('Invalid data for email confirmation');
            }
            $this-> db-> queryBuilder('update')-> table('users')-> set([['sub_token'=> ''], ['status'=> 0]])-> where(['id'=> $checkUser['id']])-> query();
        } elseif ($checkUser['status'] == 2) {
            throw new Exception('Password is reset');
        }
        unset($checkUser['password'], $checkUser['salt'], $checkUser['token'], $checkUser['sub_token']);
        return $checkUser;
    }



    public function authorization($user){
        if (empty($_COOKIE['token'])) {
            $token =sha1(time().random_int(0, PHP_INT_MAX));
            setcookie('token', $token, time()+365*864, '/', 'serv.secret.com', false, true);
            $this-> db-> queryBuilder('update')-> table('users')->set(['token'=>$token])-> where(['id'=> $user['id']])-> query();
            foreach ($user as $key => $value) {
                $this-> $key = $value;
            }
        }
        $this-> isUser = true;
    }

    public function logout(){
        unset($_COOKIE['token']);
        $_SESSION = [];
        setcookie('token', '', time() - 1000, '/', '.serv.secret.com');
    }
}