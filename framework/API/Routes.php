<?php

class Routes {
    public function __construct($router){
        $router -> get('/', 'main@actionPage');
        $router->get('/posts', 'post@actionShow');
        $router->get('/posts/:id', 'post@actionShow');
        $router -> get('/user/register', 'user@actionRegister');
        $router -> get('/user/authorization/', 'user@actionAuthorization');
        $router -> get('/user/users/', 'user@actionAuthorization');
        $router -> get('/error/notfound', 'error@actionNotfound');
    }
}