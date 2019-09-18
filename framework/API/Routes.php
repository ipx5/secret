<?php

class Routes {
    public function __construct($router){
        // $router->get('/posts', function() {
        //     echo 'Welcome ';
        // });
        $router->get('/posts', 'post@actionShow');
    }
}