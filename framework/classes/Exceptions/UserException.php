<?php

class httpException extends Exception {
    protected $httpMessage = [
        404=> 'Not Found',
    ];
    public function __construct(int $code = 0, string $message = "") {
        parent::__construct($message, $code);
    }
    public function sendHttpState() {
        header('HTTP/1.0 ' . $this->getCode() . ' ' . $this -> httpMessage[$this -> getCode()]);
    }
}