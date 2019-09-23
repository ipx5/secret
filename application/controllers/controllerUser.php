<?php

class controllerUser extends Controller{
    public $templateDir = 'user';

    public function actionUsers(){
        $users= $this-> getModel('users')-> usersList();
        $this -> responeSendHtml(
            ['lo_content' => $this-> renderTemplate( 'usersList', ['users' => $users])]
        );
    }
    public function actionEditUser(){
        $error = '';
        if($this -> getRequest()-> isForm){
            try{
                $this-> getModel('users')-> saveUser(app::getInstance()-> request-> request);
                $this -> responseSetHeader('location:/user/users');
            } catch (Exception $e){
                echo 'wewe';
                $error = $e-> getMessage();
            }
        }
        $id = $this -> getRequest() -> request['id'] ?? 0;
        $user = $this-> getModel('users')-> getUserById($id);
        $roles = $this-> getModel('roles')-> rolesList();

        $this -> responeSendHtml([
                'lo_content' => $this-> renderTemplate('userEdit', [
                    'user' => $user,
                    'roles' => $roles,
                    'errors' => $error
                ])
            ]);
    }

    public function actionRegister(){
        $usersModel= $this-> getModel('users');
        $db = new Pgsql( app::getInstance()-> db['local']);
        $users = $usersModel -> userRefister();
        foreach ($users as $user) {
            switch($user['status']){
                case 1:
                    echo 'Status: '.$user['status'].' авторизация : <a target="_blank" href="/user/authorization?token='.$user['sub_token'].'">'.$user['email'].'</a><br/>';
                    break;
                case 2:
                    echo $user['status'].' <a target="_blank" href="/user/restore?token='.$user['sub_token'].'">'.$user['email'].'</a><br/>';
                    break;
            }
        }
    }

    public function actionRegistration(){

        $data = $this -> getRequest()-> request;
        if( $this -> getRequest() -> isForm ){
            try{
                $this -> getUser()-> registration($this -> getRequest()-> request);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }
        $this -> responeSendHtml([
            'lo_content' => $this-> renderTemplate('registration', $data)
        ]);
    }

    public function actionAuthorization(){
        $data = $this -> getRequest() -> request;
        if ( $this -> getRequest()-> isForm ){
            try{
                $user = $this -> getUser()-> authenticate($this -> getRequest()-> request);
                $this -> getUser() -> authorization($user);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }
        $this -> responeSendHtml([
                'lo_content' => $this-> renderTemplate('authorization', $data)
            ]);
        
    }

    public function actionReset(){
        $data = $this -> getRequest() -> request;
        if ( $this -> getRequest()-> isForm ){
            try{
                $this -> getUser() -> reset($this -> getRequest()-> request);
                $this -> responseSetHeader('location:/user/resetSuccess?email='.app::getInstance()-> request-> request['email']);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
            $this -> responeSendHtml([
                    'lo_content' => $this-> renderTemplate('reset')
                ]
            );
        }
    }
    
    public function actionResetSuccess(){
        $this -> responeSendHtml([
            'lo_content' => $this-> renderTemplate('resetSuccess', ['email' => app::getInstance()-> request-> request['email']])
        ]);
    }

    public function actionRestore(){
        $data = $this -> getRequest() -> request;
        if ( $this -> getRequest()-> isForm ){
            try {
                $this -> getUser()-> restore($data);
                $this -> responseSetHeader('location:/user/authorization');
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }
        $this -> responeSendHtml([
            'lo_content' => $this-> renderTemplate('restore', ['token' => $data['token']])
        ]);
    }
    
    public function actionLogout(){
        $this -> getUser() -> logout();
        $this -> responseSetHeader('location:/user/authorization');
    }
}