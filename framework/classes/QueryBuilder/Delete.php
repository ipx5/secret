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
        if (gettype($condition) == 'array' && gettype(reset($condition)) == 'array') {
            foreach ($condition as $key => $value) {
                if (gettype($value) == 'number') {
                    $sql .= $key . '=' . $value;
                } else {
                    $sql .= $this -> toScreen($value);
                }
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
            if (($key == 0 && $value == 'AND') || ($key == 0 && $value == 'OR') || ($key == 0 && $value == 'and') || ($key == 0 && $value == 'or')) {
                $sql .= $value . ' ';
            } else {
                // TEST
                if ($value[0] == ':') {
                    $sql .= $key . '=' . substr($value, 1) . ' ';
                }
                // TEST
                $sql .= $key . '=' . '\'' . $value . '\' ';
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