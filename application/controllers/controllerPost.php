<?php 

class controllerPost extends Controller {
    public function __construct(){
        parent::__construct();
    }
    public function actionShow($params)
    {
        $model = $this-> getModel('posts');
        if (!empty($params['id'])) {
            $posts = $model -> getUser($params['id']);
        } else {
            $posts = $model -> postsList();
        }
        $data = ['data' => $posts];

        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }
}