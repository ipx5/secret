<?php 

class Blog extends Model {

    public function blogList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('blog')-> query();
    }

    public function getInfo($id) {
        return $this-> db-> queryBuilder('select')-> select('*') -> from('blog') -> where(['id' => $id]) -> query();
    }

    public function getAvatar($id){
        return $this-> db-> queryBuilder('select')-> select('avatar') -> from('avatar')-> where(['blog_id'=> $id])-> query();
    }

    public function getLikes($id){
        return $this-> db-> queryBuilder('select')-> select('likes') -> from('post')-> where(['post_id'=> $id])-> query();
    }

    public function getFollowing($id){
        return $this-> db-> queryBuilder('select')-> select('likes') -> from('post')-> where(['post_id'=> $id])-> query();
    }
}