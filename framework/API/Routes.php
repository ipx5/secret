    <?php

class Routes {
    public function __construct($router){
        //$router -> get('/', 'main@actionPage');
        //$router->get('/posts', 'post@actionShow');
        //$router->get('/posts/:id', 'post@actionShow');
        // $router -> get('/user/register/', 'user@actionRegister');
        // $router -> get('/user/authorization/', 'user@actionAuthorization');
        // $router -> get('/user/users/', 'user@actionUsers');
        // $router -> get('/error/notfound', 'error@actionNotfound');
        
        //$router -> post('/user/registration', 'user@actionRegistration');
        // $router -> get('/user/editUser', 'user@actionEditUser');
        // $router -> get('/user/reset','user@actionReset');
        // $router -> get('/user/logout','user@actionLogout');
        // $router -> get('/role/show/', 'role@actionShow');
        // $router -> get('/role/edit/', 'role@actionEdit');
        // $router -> post('/role/edit/', 'role@actionEdit');
        // $router -> get('/user/restore/', 'user@actionRestore');

        //BlogMethod
        $router -> get('/info/:id', 'blog@actionGetInfo');
        $router -> get('/avatar/:id', 'blog@actionGetAvatar');
        $router -> get('/likes/:id', 'blog@actionGetLikes');
        $router -> get('/following/:id', 'blog@actionGetFollowing');
        $router -> get('/followers/:id', 'blog@actionGetFollowers');
        $router -> get('/posts/:id', 'blog@actionGetPosts');

        $router -> post('/post/:id', 'blog@actionPost');
        $router -> post('/post/edit/:id', 'blog@actionEditPost');
        $router -> post('/post/delete/:id', 'blog@actionDeletePost');

        //UserMethod
        
        $router -> get('/user/info/:id', 'user@actionGetInfo');
        $router -> get('/user/likes/:id', 'user@actionGetLikes');
        $router -> get('/user/following/:id', 'user@actionGetFollowing');

        $router -> post('/user', 'user@actionCreateUser');
        $router -> post('/user/follow/:id', 'user@actionFollow');
        $router -> post('/user/unfollow/:id', 'user@actionUnfollow');
        $router -> post('/user/like/:id', 'user@actionLike');
        $router -> post('/user/unlike/:id', 'user@actionLike');

        //TaggedMethod
        $router -> post('/tagged', 'tag@actionGetPostsByTag');

    }
}