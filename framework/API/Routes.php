<?php

class Routes {
    public function __construct($router){
        $router->get('/e', function() {
            echo 'Welcome ';
        });
    }
}