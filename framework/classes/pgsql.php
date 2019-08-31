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
    protected $condition = '';
    protected $insertInto = '';
    protected $insertFields = '';
    protected $values = '';
    protected $updateTerm = '';
    protected $columns = '';
    protected $escapeValues = '';

    public function select($fields = '*') {
        $this-> queryType = self::TYPE_SELECT;
        $this->selectFields = $fields;
        return $this;
    }
    
    public function insert($tableName) {
        $this->queryType = self::TYPE_INSERT;
        $this->table = $tableName;
        return $this;
    }

    public function columns($columns) {
        if (gettype($columns) == 'array' && count($columns) > 1) {
            $this -> columns = implode(',', $columns);
        } else {
            $this -> columns = $columns;
        };
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

    public function testSQL($values) {
        $sql = '(';
        foreach ($values as $key => $value) {
            if (count($values)-1 == $key) {
                $sql .=  '\'' .$value . '\'';
            } else {
                $sql .= '\'' .$value . '\',';
            }
        }
        return $sql .= ')';
    }
    
    public function values($values) {
        if (gettype(reset($values)) == 'array') {
            foreach ($values as $key => $value) {
                if (count($values)-1 == $key) {
                    $this -> values .= $this -> testSQL($value);
                } else {
                    $this -> values .= $this -> testSQL($value) . ', ';
                }
            }
        } else {
            $this -> values .= $this->testSQL($values);
        }
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
        if (gettype($data) == 'array') {
            foreach ($data as $key => $value) {
                if ($key == count($data)-1) {
                    $this -> escapeValues .= pg_escape_string($value);
                } else {
                    $this -> escapeValues .= pg_escape_string($value) . ',';
                }
            }
        } else {
            $this -> escapeValues .= pg_escape_string($data);
        }
        return $this;
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
    
    protected function getInsertText() {
        $sql = 'INSERT INTO ' . $this -> table  . (($this -> columns) ? ' (' . ($this -> columns) . ') ' : '')  . ' VALUES ' . $this -> values;
        return $sql;
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