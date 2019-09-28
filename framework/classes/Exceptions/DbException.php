<?php

class dbException extends Exception {
    public $codeError;
    public $messageError;
    protected $httpMessage = [
        404=> 'Not Found',
    ];

    public function __construct(int $code = 0, string $message = "") {
        parent::__construct($message, $code);
        $this -> codeError = $code;
        $this -> messageError = $message;
    }
    //TODO
    public function sendHttpState() {
        header('HTTP/1.0 ' . $this->getCode() . ' ' . $this -> httpMessage[$this -> getCode()]);

        echo $this -> messageError;
    }
}
