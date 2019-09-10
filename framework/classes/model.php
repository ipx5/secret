<?php

abstract class model {
    protected $db = false;
    public function __construct() {
        if ($this->db == false) {
            $this->db = new Pgsql(app::getInstance()->db['local']);
        }
    }
}