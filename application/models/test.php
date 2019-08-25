<?php

class test extends model {
    public function first() {
        $this->db->querySimple("INSERT INTO users(email, password) VALUES ('test@test.ru', '1234')");
        $users = $this->db->selectQuery('select * from users');
    }
}