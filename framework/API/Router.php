<?php


class Router {

    protected $url;
    protected $method;
    private $router = [];
    private $matchRouter = [];

    public function __construct($url, $method) {
        $this -> url = rtrim($url);
        $this -> method = $method;
    }

    private function getMatchRoutersByRequestMethod() {
        $url = explode('/api', $this -> url)[1];
        if (!$url) $url = '/';
        foreach ($this->router as $value) {
            if (strtoupper($this->method) == $value->getMethod() && $url == $value -> getPattern())
                array_push($this->matchRouter, $value);
        }
    }

    public function addRoute($method, $pattern, $callback) {
        array_push($this->router, new Route($method, $pattern, $callback));
    }

    public function get($pattern, $callback) {
        $this -> addRoute('GET', $pattern, $callback);
    }

    public function post($pattern, $callback) {
        $this -> addRoute('POST', $pattern, $callback);
    }

    public function delete($pattern, $callback) {
        $this -> addRoute('DELETE', $pattern, $callback);
    }

    public function put($pattern, $callback) {
        $this -> addRoute('PUT', $pattern, $callback);
    }

    public function run() {
        $this->getMatchRoutersByRequestMethod();
        if (is_callable($this->matchRouter[0]->getCallback()))
            call_user_func($this->matchRouter[0]->getCallback());
        else
            $this->runController();
    }

    public function runController() {

    }
}