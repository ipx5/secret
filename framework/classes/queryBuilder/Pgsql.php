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
        $className = ucfirst($type);
        $this -> currentState = new $className($this);
        $this -> queryType = $type;
        return $this -> currentState;
    }

    public function query() {
        $nameMethod = 'get' . ucfirst($this -> queryType) . 'Text';
        $sql = $this -> $nameMethod();
        $this -> clear();
        if ($this -> queryType == 'select') {
            return $this -> currentState -> selectQuery($sql);
        } else {
            return pg_query($this->connection, $sql);
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