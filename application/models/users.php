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
        -> columns(['email','username','password','salt','status','sub_token', 'role_id'])
        -> values([$user->email,$user->username,$user->password,$user->salt,$user->status,$user->sub_token, 1])
        -> query();
    }

    public function getInfo($id){
        return $this -> db-> queryBuilder('select')-> select('*')-> from('users')-> where(['id'=> $id])-> query();
    }

    public function startFollow($params){
        $checkFollow = $this-> db-> queryBuilder('select')
        -> select(['b.*'])
        -> from(['blog_users' => 'bu'])
        -> join('JOIN', ['blog' => 'b'] , ['b.id' => 'bu.blog_id'])
        -> where(['bu.is_follower' => true, 
        'AND', 'bu.user_id' => $params['user_id'] , 
        'AND', 'bu.blog_id' => $params['blog_id']])-> query();

        if(empty($checkUsername)){
            $this-> db-> queryBuilder('insert')
            -> insert('blog_users')
            -> columns(['blog_id','user_id','is_follower'])
            -> values([$params['blog_id'],$params['user_id'],true])
            -> query();
        }
    }

    public function stopFollow($params){
        $checkFollow = $this-> db-> queryBuilder('select')
        -> select(['b.*'])
        -> from(['blog_users' => 'bu'])
        -> join('JOIN', ['blog' => 'b'] , ['b.id' => 'bu.blog_id'])
        -> where(['bu.is_follower' => true, 
        'AND', 'bu.user_id' => $params['user_id'] , 
        'AND', 'bu.blog_id' => $params['blog_id']])-> query();

        if(!empty($checkUsername)){
            $this-> db-> queryBuilder('update')
            -> table('blog_users')
            -> set(['is_follower'=> false])-> where([['user_id' => $params['user_id']], 
            ['AND'], ['blog_id' => $params['blog_id']]])-> query();
        }
    }

    public function startLike($params){
        $checkLike = $this-> db-> queryBuilder('select')
        -> select(['p.*'])
        -> from(['post_users' => 'pu'])
        -> join('JOIN', ['post' => 'p'] , ['p.id' => 'pu.post_id'])
        -> where(['pu.is_like' => true, 
        'AND', 'pu.user_id' => $params['user_id'] , 
        'AND', 'pu.post_id' => $params['post_id']])-> query();

        if(empty($checkUsername)){
            $this-> db-> queryBuilder('insert')
            -> insert('post_users')
            -> columns(['post_id','user_id','is_like'])
            -> values([$params['post_id'],$params['user_id'],true])
            -> query();

            $this-> db-> queryBuilder('update')
            -> table('post')
            -> set(['likes'=> 'likes'+1])-> where(['id' => $params['post_id']])-> query();
        }
    }

    public function stopLike($params){
        $checkLike = $this-> db-> queryBuilder('select')
        -> select(['p.*'])
        -> from(['post_users' => 'pu'])
        -> join('JOIN', ['post' => 'p'] , ['p.id' => 'pu.post_id'])
        -> where(['pu.is_like' => true, 
        'AND', 'pu.user_id' => $params['user_id'] , 
        'AND', 'pu.post_id' => $params['post_id']])-> query();

        if(!empty($checkUsername)){
            $this-> db-> queryBuilder('update')
            -> table('post_users')
            -> set(['is_like'=> false])-> where([['user_id' => $params['user_id']], 
            ['AND'], ['post_id' => $params['post_id']]])-> query();

            $this-> db-> queryBuilder('update')
            -> table('post')
            -> set(['likes'=> 'likes'-1])-> where(['id' => $params['post_id']])-> query();
        }
    }
}