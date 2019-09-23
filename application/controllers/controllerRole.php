<?php

class controllerRole extends Controller {
    protected $templateDir = 'role';
    public function __construct(){
        parent::__construct();
    }

    public function actionShow(){
        $roles = $this-> getModel('roles')-> rolesList();
        $this -> responeSendHtml(
            ['lo_content' => $this-> renderTemplate('roleList',['roles'=> $roles])]
        );
    }

    public function actionEdit(){
        $error = '';
        if($this -> getRequest() -> isForm){
            try{
                $this-> getModel('roles')-> saveRole(app::getInstance()-> request-> request);
                $this -> responseSetHeader('location:/role/show');
            } catch (Exception $e){
                $error = $e-> getMessage();
            }
        }
        $id = $this -> getRequest() -> request['id'] ?? 0;
        $priveileges = $this-> getModel('roles')-> privilegesList();
        $role = $this-> getModel('roles')-> roleInfoById($id);
        $this -> responeSendHtml([
            'lo_content' => $this-> renderTemplate('roleEdit', [
                'privileges' => $priveileges,
                'role' => $role,
                'errors' => $error
            ])
        ]);
    }
}