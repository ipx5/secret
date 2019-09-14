<?php

class controllerTest extends controller {
    public function __construct() {
        parent::__construct();
    }
    public function actionPage()
    {
        if(!app::getInstance()-> user-> isUser){
            echo header('location: /user/autorization/');
        }
        $this-> renderLayout([
            'lo_content'=>'It works ' . app::getInstance()-> user-> email.'<br />',
        ]);
        //echo 'It works ' . app::getInstance()-> user-> email.'<br />;
    }
}

