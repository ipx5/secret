<?php

class pgsql {    
    private $connection = false;
    public function __construct($config) {
        if ($this->connection == false) {
            $this->connection = pg_connect('host= ' . $config['host'] . ' port=' . $config['port'] . ' dbname=' . $config['dbname'] . ' user=' . $config['user'] . ' password=' . $config['password']);
        }
    }
    
    public function querySimple($sql) {
        return pg_query($this->connection, $sql);
    }

    public function selectQuery($sql) {
        $res = pg_query($this->connection, $sql);
        $out = [];
        $current = false;
        while ($current = pg_fetch_assoc($res)) {
            $out[] = $current;
        }
        return $out;
    }
            
    const TYPE_SELECT = 1;
    const TYPE_INSERT = 2;
    const TYPE_UPDATE = 3;
    const TYPE_DELETE = 4;
    
    protected $queryType = 0;
    protected $selectFields = '';
    protected $table = '';
    protected $tableAlias = 't';
    protected $condition = '';
    protected $insertInto = '';
    protected $insertFields = '';
    protected $updateTerm = '';


    public function select($fields = '*') {
        $this-> queryType = self::TYPE_SELECT;
        $this->selectFields = $fields;
        return $this;
    }
    
    public function insertInto($tname) {
        $this->queryType = self::TYPE_INSERT;
        $this-> insertInto = $tname;
        return $this;
    }
    
    public function update($tname) {
        $this->queryType = self::TYPE_UPDATE;
        $this-> table = $tname;
        return $this;
    }
    
    public function set($term) {
        $this->updateTerm = $term;
        return $this;
    }

    public function deleteFrom($tname) {
        $this->queryType = self::TYPE_DELETE;
        $this->table = $tname;
        return $this;
    }
    
    public function insertValues($values) {
        $this->insertFields = $values;
        return $this;
    }

    public function from($table) {
        $this->table = $table;
        return $this;
    }
    public function where($condition) {
        $this->condition = $condition;
        return $this;
    }
    
    public function escape($data) {
        return pg_escape_string($data);
    }
    
    public function query() {
        $sql = $this->getText();
        if ($this->queryType == self::TYPE_SELECT) {
            return $this->selectQuery($sql);
        } else {
            return $this->querySimple($sql);
        }
    }
    
    public function getText() {
        $sql = '';
        switch ($this->queryType) {
            case self::TYPE_SELECT:
                $sql = $this->getSelectText();
                break;
            case self::TYPE_INSERT:
                $sql = $this->getInsertText();
                break;
            case self::TYPE_UPDATE:
                $sql = $this->getUpdateText();
                break;
            case self::TYPE_DELETE:
                $sql = $this->getDeleteText();
                break;
        }
        return $sql;
    }
    
    protected function getSelectText() {
        $sql = 'SELECT ' . $this->selectFields . ' FROM ' . $this->table;
        
        if (!empty($this->condition)) {
            $sql .= ' WHERE ' . $this->condition;
        }
        
        return $sql;
    }
    
    protected function getInsertText(array $data) {
        $fields = '';
        $values = '';
        foreach ($data as $rowName => $value) {
            $fields .= ($fields == '' ? '': ',') . $rowName;
            $values .= ($values == '' ? ',' : '\'') . $this->escape($value);
        }
    }
    
    protected function getDeleteText() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->condition;
        return $sql;
    }
    
    protected function getUpdateText() {
        $sql = 'UPDATE ' . $this->table . ' SET ' . $this->updateTerm . ' WHERE '. $this->condition;
        return $sql;
    }
    
}