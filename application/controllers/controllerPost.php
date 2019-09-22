<?php 

class controllerPost extends Controller {
    public function __construct(){
        parent::__construct();
    }
    public function actionShow($params)
    {
        $model = $this-> getModel('posts');
        if ($params['id']) {
            $posts = $model -> getUser($params['id']);
        }
        $data = ['data' => $posts];

        $this->response->sendStatus(200);
        $this->response->setContent($data);
        $this->response->render();
    }
}