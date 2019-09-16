<?php 

class controllerPost extends Controller {
    public function __construct(){
        parent::__construct();
    }
    public function actionShow()
    {
        $posts = $this-> getModel('posts')-> postsList();
        $data = ['data' => $posts];

        $this->response->sendStatus(200);
        $this->response->setContent($data);
        $this->response->render();
    }
}