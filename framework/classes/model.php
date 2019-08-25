<?php

abstract class model {
    protected $db = false;
    public function __construct() {
        if ($this->db == false) {
            $this->db = new pgsql(app::getInstance()->db['local']);
        }
    }
}