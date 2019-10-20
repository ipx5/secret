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
        return $this-> db-> queryBuilder('select')
        -> select(['b.*'])
        -> from(['blog_users' => 'bu'])
        -> join('JOIN', ['blog' => 'b'] , ['b.id' => 'bu.blog_id'])
        -> where(['bu.is_follower' => true, 'AND', 'bu.user_id' => $id])-> query();
    }

    public function getFollowers($id){
        return $this-> db-> queryBuilder('select')
        -> select(['u.*'])
        -> from(['blog_users' => 'bu'])
        -> join('JOIN', ['users' => 'u'] , ['u.id' => 'bu.user_id'])
        -> where(['bu.is_follower' => true, 'AND', 'bu.blog_id' => $id])-> query();
    }
    
    public function postsList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('post')-> query();
    }

    public function getPosts($id){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('post')-> where(['blog_id'=> $id])-> query();
    }

    public function createPost($data, $id){
        $this-> db-> queryBuilder('insert')
            -> insert('post')
            -> columns(['title','text','blog_id'])
            -> values([$data['title'], $data['text'], $data['id']])-> query();
    }

    public function updatePost($data, $id){
        $this-> db-> queryBuilder('update')-> table('post')-> set([['title'=> $data->title],['data'=> $data->data]] )-> where(['id'=> $id])-> query();
    }

    public function deletePost($id){
        $this-> db-> queryBuilder('delete') -> from('post') -> where(['id'=> $id])-> query();
    }

}


