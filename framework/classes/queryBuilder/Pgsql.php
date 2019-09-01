<?php


interface PgsqlBehavior {
    public function queryBuilder($queryType);
    public function query();
    public function escape($data);
    public function clear();
}

class Pgsql implements PgsqlBehavior {
    protected $queryType;
    protected $currentState;
    public $table;
    public $columns;
    public $values;
    public $where;
    public $connection = false;
    public function __construct($config) {
        if ($this->connection == false) {
            $this->connection = pg_connect('host= ' . $config['host'] . ' port=' . $config['port'] . ' dbname=' . $config['dbname'] . ' user=' . $config['user'] . ' password=' . $config['password']);
        }
    }
    public function queryBuilder($type) {
        switch ($type) {
            case 'insert':
                $this -> queryType = $type;
                return $this -> currentState = new Insert($this);
            case 'select':
                $this -> queryType = $type;
                return $this -> currentState = new Select($this);
            case 'delete':
                $this -> queryType = $type;
                return $this -> currentState = new Delete($this);
            case 'update':
                $this -> queryType = $type;
                return $this -> currentState = new Update($this);
        }
    }

    public function query() {
        switch ($this->queryType) {
            case 'insert':
                $sql = $this -> getInsertText();
                $this -> clear();
                return pg_query($this->connection, $sql);
            case 'select':
                $sql = $this -> getSelectText();
                $this -> clear();
                return $this -> currentState -> selectQuery($sql);
            case 'delete':
                $sql = $this -> getDeleteText();
                $this -> clear();
                return pg_query($this -> connection, $sql);
            case 'update':
                $sql = $this -> getUpdateText();
                $this -> clear();
                return pg_query($this -> connection, $sql);
        }
    }

    public function clear() {
        $this -> values = '';
        $this -> columns = '';
        $this -> table = '';
        $this -> where = '';
    }

    public function __call($name, $params) {
        return $this -> currentState -> $name(reset($params));
    }

    public function escape($data) {
        $escapeValues = '';
        if (gettype($data) == 'array') {
            foreach ($data as $key => $value) {
                if ($key == count($data)-1) {
                    $escapeValues .= pg_escape_string($value);
                } else {
                    $escapeValues .= pg_escape_string($value) . ',';
                }
            }
        } else {
            $escapeValues .= pg_escape_string($data);
        }
        return $this;
    }
}