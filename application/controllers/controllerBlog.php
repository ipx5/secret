<?php 

class controllerBlog extends Controller {
    public function __construct(){
        parent::__construct();
    }
    public function actionGetInfo($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $info = $model -> getInfo($params['id']);
        } else {
            $info = $model -> blogList();
        }
        $data = ['data' => $info];

        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetAvatar($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $avatar = $model -> getAvatar($params['id']);
        } else{
            //todo
        }
        $data = ['data' => $avatar];

        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetLikes($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $likes = $model -> getLikes($params['id']);
        } else{
            //todo
        }
        $data = ['data' => $likes];

        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetFollowing($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $likes = $model -> getFollowing($params['id']);
        } else{
            //todo
        }
        $data = ['data' => $likes];

        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }
}