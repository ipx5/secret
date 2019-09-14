<?php


interface PgsqlBehavior {
    public function queryBuilder($queryType);
    public function query();
//    public function escape($data);
    public function clear();
}

class Pgsql implements PgsqlBehavior {
    protected $queryType;
    protected $currentState;
    public $table;
    public $columns;
    public $values;
    public $where;
    public $returning;
    public $limit;
    public $offset;
    public $orderBy;
    public $join;
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
        } else if ($this -> returning) {
            $result = pg_query($this->connection, $sql);
            $insert_row = pg_fetch_row($result);
            return $insert_id = $insert_row[0];
        } else {
            return pg_query($this->connection, $sql);
        }
    }

    public function __call($name, $params) {
        return $this -> currentState -> $name(reset($params));
    }

    public function where($condition) {
        // [..., ..., ..., ...] 1 array
        // [ [...], [...], [...], [...] ] arrays in array
        $typeQuery = gettype(reset($condition));
        $sql = '';
        if ($typeQuery == 'array') {
            foreach ($condition as $value) {
                $sql .= $this -> toScreen($value);
            }
        } else {
            $sql = $this -> toScreen($condition);
        }
        $this-> where = $sql;
        return $this;
    }

    public function toScreen($values, $commaOrSpace = ' ') {
        // [ ..., ..., ... ] one array
        $specialValues = ['AND', 'OR', 'and', 'or'];
        $chunkWhere = '';
        $sign = '=';
        foreach ($values as $key => $value) {
            $comma = $commaOrSpace;
            if ($chunkWhere === '' && $comma == ',') {
                $comma = '';
            }
            $keyStatusIsDigit = ctype_digit($key) || is_int($key);
            $valueStatusIsDigit = ctype_digit($value) || is_int($value);
            if ($keyStatusIsDigit && in_array($value, $specialValues)) {
                $chunkWhere .=$comma . $value;
            }
            else if ($keyStatusIsDigit && $value === '!') {
                $sign = '!=';
            } else if ($keyStatusIsDigit) {
                $chunkWhere .= $comma . $value;
            } else if (!$valueStatusIsDigit && strlen($value) && $value[0] === ':') {
                $chunkWhere .= $comma . $key . $sign . substr($value, 1);
                $sign = '=';
            } else if ($valueStatusIsDigit) {
                $chunkWhere .= $comma . $key . $sign . $value;
                $sign = '=';
            } else {
                $chunkWhere .= $comma . $key . $sign . '\'' . $value . '\'';
                $sign = '=';
            }
        }
        return $chunkWhere;
    }

    public function clear() {
        $this -> values = '';
        $this -> columns = '';
        $this -> table = '';
        $this -> where = '';
        $this -> limit = '';
        $this -> offset = '';
        $this -> orderBy = '';
        $this -> join = '';
    }
}