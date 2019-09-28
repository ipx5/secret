<?php

class dbException extends Exception {
    public $codeError;
    public $messageError;
    protected $httpMessage = [
        404=> 'Not Found',
        406 => 'Not Acceptable',
        501 => 'Not Implemented',
        200 => 'OK',
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

        app::getInstance() -> response -> setContent($this -> messageError);

    }
}
