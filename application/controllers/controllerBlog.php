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
        }
        $data = ['data' => $avatar];
        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetLikes($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $likes = $model -> getLikes($params['id']);
        }
        $data = ['data' => $likes];
        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetFollowing($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $following = $model -> getFollowing($params['id']);
        }
        $data = ['data' => $following];
        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetFollowers($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $followers = $model -> getFollowers($params['id']);
        }
        $data = ['data' => $followers];
        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionGetPosts($params){
        $model = $this-> getModel('blog');
        if (!empty($params['id'])) {
            $posts = $model -> getPosts($params['id']);
        } else {
            $posts = $model -> postsList();
        }
        $data = ['data' => $posts];
        $this -> responseSendStatus(200);
        $this -> responseSetContent($data);
    }

    public function actionPost($params){
        if (!empty($params['id'])) {
            $data = $this->requestGetContent();
            $this-> getModel('blog')-> createPost($data, $params['id']);
            $this -> responseSendStatus(200);
            $this-> responseSetContent(array("message" => "Post was created."));
        } 
    }

    public function actionEditPost($params){
        if (!empty($params['id'])) {
            $data = $this->requestGetContent();
            $this-> getModel('blog')-> updatePost($data, $params['id']);
            $this -> responseSendStatus(200);
            $this-> responseSetContent(array("message" => "Post was updated."));
        }
    }

    public function actionDeletePost($params){
        if (!empty($params['id'])) {
            $this-> getModel('blog')-> deletePost($params['id']);
        }
        $this -> responseSendStatus(200);
        $this-> responseSetContent(array("message" => "Post was deleted."));
    }

}