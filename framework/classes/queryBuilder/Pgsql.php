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
                include_once 'framework/classes/queryBuilder/Insert.php';
                $this -> queryType = $type;
                return $this -> currentState = new InsertClass($this);
            case 'select':
                include_once 'framework/classes/queryBuilder/Select.php';
                $this -> queryType = $type;
                return $this -> currentState = new SelectClass($this);
            case 'delete':
                include_once 'framework/classes/queryBuilder/Delete.php';
                $this -> queryType = $type;
                return $this -> currentState = new DeleteClass($this);
            case 'update':
                include_once 'framework/classes/queryBuilder/Update.php';
                $this -> queryType = $type;
                return $this -> currentState = new UpdateClass($this);
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