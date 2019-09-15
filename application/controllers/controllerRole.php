<?php

class controllerRole extends Controller {
    protected $templateDir = 'role';
    public function __construct(){
        parent::__construct();
    }

    public function actionShow(){
        $roles = $this-> getModel('roles')-> rolesList();
        echo $this-> renderLayout(['lo_content' => $this-> renderTemplate('roleList',['roles'=> $roles])]);
    }

    public function actionEdit(){
        $error = '';
        if(app::getInstance()-> request-> isForm){
            try{
                $this-> getModel('roles')-> saveRole(app::getInstance()-> request-> request);
                header('location:/role/show');
            } catch (Exception $e){
                $error = $e-> getMessage();
            }
        }
        $id = app::getInstance()-> request -> request['id'] ?? 0;
        $priveileges = $this-> getModel('roles')-> privilegesList();
        $role = $this-> getModel('roles')-> roleInfoById($id);
        echo $this-> renderLayout([
            'lo_content' => $this-> renderTemplate('roleEdit', [
                'privileges' => $priveileges,
                'role' => $role,
                'errors' => $error
            ])
        ]);
    }
}