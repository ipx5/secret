<?php


class Route {
    protected $method;
    protected $pattern;
    protected $callback;
    public function __construct($method, $pattern, $callback) {
        echo $pattern;
        $this -> method = $method;
        $this -> pattern = $pattern;
        $this -> callback = $callback;
    }

    public function getPattern() {
        return $this -> pattern;
    }

    public function getMethod() {
        return $this -> method;
    }

    public function getCallback() {
        return $this -> callback;
    }
}