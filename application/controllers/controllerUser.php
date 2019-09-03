<?php

class controllerUser extends controller{
    public $templateDir = 'user';
    public function actionRegister(){
        $db = new Pgsql( app::getInstance()-> db['local'] );
        $users = $db-> queryBuilder('select')-> select('*')-> from('users')-> where('subtoken !=\'\'')-> query();
        foreach ($users as $users) {
            echo $user['status'].' <a target="_blank" href="/user/authorization?token='.$user['sub_token'].'">'.$user['email'].'</a><br/>';
        }
    }
    public function actionRegistration(){
        $data = app::getInstance()-> request-> request;
        if( app::getInstance()-> request-> isForm ){
            try{
                app::getInstance()-> user-> registration(app::getInstance()->request->request);
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
                $user = app::getInstance()-> user-> authenticate(app::getInstance()->request->request);
                app::getInstance()-> user-> authorization($user);
            } catch (Exception $e){
                $data['error'] = $e-> getMessage();
            }
        }
        echo $this-> renderLayout([
            'lo_content' => $this-> renderTemplate('authorization', $data)
        ]);
    }
    public function actionReset()
    {
        # code...
    }
    public function actionRestore()
    {
        # code...
    }
    public function actionLogout()
    {
        app::getInstance()-> user-> logout();
        header('location:/user/authorization');
    }
}