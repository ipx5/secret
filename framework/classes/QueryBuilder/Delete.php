<?php


interface DeleteBehavior {
    public function from($tableName);
    public function getDeleteText();
    public function toScreen($value);
}

class Delete implements DeleteBehavior {
    protected $pgsql;

    public function __construct($object) {
        $this -> pgsql = $object;
    }

    public function from($tableName) {
        $this -> pgsql -> table = $tableName;
        return $this;
    }

    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

    public function where($condition) {
        $sql = '';
        if (is_array(reset($condition))) {
            foreach ($condition as $key => $value) {
                $sql .= $this -> toScreen($value);
            }
        } else {
            $sql = $this -> toScreen($condition);
        }
        $this-> pgsql -> where = $sql;
        return $this;
    }

    public function toScreen($values) {
        $sql = '';
        foreach ($values as $key => $value) {
            $typeString = is_string($value);
            if ((is_int($key) && $value == 'AND') || (is_int($key) && $value == 'OR') || (is_int($key) && $value == 'and') || (is_int($key) && $value == 'or')) {
                $sql .= $value . ' ';
            } else if ($typeString && strlen($value) && $value[0] === ':') {
                $sql .= $key . '='  . substr($value, 1) . ' ';
            } else if ($typeString) {
                $sql .= $key . '=' . '\'' . $value . '\' ';
            } else {
                $sql .= $key . '=' . $value . ' ';
            }
        }
        return $sql;
    }

    public function getDeleteText() {
        $sql = 'DELETE FROM ' . $this -> pgsql -> table;
        if (!empty($this -> pgsql -> where)) {
            $sql .= ' WHERE ' . $this -> pgsql -> where;
        };
        return $sql;
    }
}