<?php 

class controllerBlog extends Controller {
    public function __construct(){
        parent::__construct();
    }
    public function actionGetInfo($params)
    {
        $model = $this-> getModel('blogs');
        if (!empty($params['id'])) {
            $posts = $model -> getInfo($params['id']);
        } else {
            $posts = $model -> blogList();
        }
        $data = ['data' => $posts];

        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }
}