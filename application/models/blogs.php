<?php 

class Blogs extends Model {

    public function blogList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('blogs')-> query();
    }

    public function getInfo($id) {
        return $this -> db -> queryBuilder('select') -> select('*') -> from('blogs') -> where(['id' => $id]) -> query();
    }

    public function getAvatar($id){
        
    }
    


}