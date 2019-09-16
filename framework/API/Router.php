<?php


class Router {

    protected $url;
    protected $method;
    private $router = [];

    public function __construct($url, $method) {
        $this -> url = rtrim($url);
        $this -> method = $method;
    }

    public function addRoute($method, $pattern, $callback) {
        array_push($this->router, new Route($method, $pattern, $callback));
    }

    public function get($pattern, $callback) {
        $this -> addRoute('GET', $pattern, $callback);
    }
}