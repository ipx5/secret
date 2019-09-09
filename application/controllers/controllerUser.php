<?php

class controllerUser extends controller{
    public $templateDir = 'user';

    public function actionUsers(){
        $users= $this-> getModel('users')-> usersList();
        echo $this-> renderLayout(['lo_content' => $this-> renderTemplate( 'usersList', ['users' => $users])]);

    }
    public function actionEditUser(){
        $error = '';
        if(app::getInstance()-> request-> isForm){
            try{
                $this-> getModel('users')-> saveUser(app::getInstance()-> request-> request);
                header('location:/user/users');
            } catch (Exception $e){
                $error = $e-> getMessage();
            }
        }
        $id = app::getInstance()-> request -> request['id'] ?? 0;
        $user = $this-> getModel('users')-> getUserById($id);
        $roles = $this-> getModel('roles')-> rolesList();

        echo $this-> renderLayout([
            'lo_content' => $this-> renderTemplate('userEdit', [
                'user' => $user,
                'roles' => $roles,
                'errors' => $error
            ])
        ]);
    }

    public function actionRegister(){
        $db = new Pgsql( app::getInstance()-> db['local'] );
        $users = $db-> queryBuilder('select')-> select('*')-> from('users')-> where(['!', 'sub_token' => ''])-> query();
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
        $data = app::getInstance()-> request-> request;
        if( app::getInstance()-> request-> isForm ){
            try{
                app::getInstance()-> user-> registration(app::getInstance()-> request-> request);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }
        echo $this->renderLayout([
            'lo_content' => $this-> renderTemplate('registration', $data)
        ]);
    }

    public function actionAuthorization(){
        $data = app::getInstance()-> request -> request;
        if ( app::getInstance()-> request-> isForm ){
            try{
                $user = app::getInstance()-> user-> authenticate(app::getInstance()-> request-> request);
                app::getInstance()-> user-> authorization($user);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }
        echo $this-> renderLayout([
            'lo_content' => $this-> renderTemplate('authorization', $data)
        ]);
        
    }

    public function actionReset(){
        $data = app::getInstance()-> request -> request;
        if ( app::getInstance()-> request-> isForm ){
            try{
                app::getInstance()-> user-> reset(app::getInstance()-> request-> request);
                header('location:/user/resetSuccess?email='.app::getInstance()-> request-> request['email']);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
            echo $this-> renderLayout([
            'lo_content' => $this-> renderTemplate('reset')
            ]);
        }
    }
    
    public function actionResetSuccess(){
        echo $this-> renderLayout([
            'lo_content' => $this-> renderTemplate('resetSuccess', ['email' => app::getInstance()-> request-> request['email']])
            ]);
    }

    public function actionRestore(){
        $data = app::getInstance()-> request -> request;
        if ( app::getInstance()-> request-> isForm ){
            try {
                app::getInstance()-> user-> restore($data);
                echo header('location:/user/authorization');
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }

        echo $this-> renderLayout([
            
            'lo_content' => $this-> renderTemplate('restore', ['token' => $data['token']])
        ]);
    }
    
    public function actionLogout(){
        app::getInstance()-> user-> logout();
        header('location:/user/authorization');
    }
}