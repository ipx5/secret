<?php

abstract class model {
    protected $db = false;
    public function __construct() {
        if ($this->db == false) {
            $this->db = new Pgsql(app::getInstance()->db['local']);
        }
    }

    public function insertFakeUsers() {
        $this -> db -> insert('users') -> columns(['email', 'password']) ->
            values([['test@gmail.com', 'test'], ['nobody@yandex.ru', 'nodody'],
                    ['superman@mail.ru', 'superman']
            ]) -> query();
    }
}