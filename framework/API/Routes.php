<?php

class Routes {
    public function __construct($router){
        $router -> get('/', 'main@actionPage');
        $router->get('/posts', 'post@actionShow');
        $router->get('/posts/:id', 'post@actionShow');
        $router -> get('/user/register/', 'user@actionRegister');
        $router -> get('/user/authorization/', 'user@actionAuthorization');
        $router -> get('/user/users/', 'user@actionUsers');
        $router -> get('/error/notfound', 'error@actionNotfound');
        $router -> get('/user/registration', 'user@actionRegistration');
        $router -> post('/user/registration', 'user@actionRegistration');
        $router -> get('/user/editUser', 'user@actionEditUser');
        $router -> get('/user/reset','user@actionReset');
        $router -> get('/user/logout','user@actionLogout');
        $router -> get('/role/show/', 'role@actionShow');
        $router -> get('/role/edit/', 'role@actionEdit');
        $router -> post('/role/edit/', 'role@actionEdit');
        $router -> get('/user/restore/', 'user@actionRestore');
//        $router -> get('')
    }
}