<?php


interface UpdateBehavior {
    public function table($tableName);
    public function set($values);
    public function getUpdateText();
    public function toScreenWhere($value);
    public function toScreenSet($value);
    public function where($value);
}

class Update implements UpdateBehavior {
    protected $pgsql;

    public function __construct($object) {
        $this -> pgsql = $object;
    }

    public function table($tableName) {
        $this -> pgsql -> table = $tableName;
        return $this;
    }

    public function set($values) {
        if (gettype(reset($values)) == 'array') {
            foreach ($values as $key => $value) {
                if (count($values)-1 == $key) {
                    $this -> pgsql -> values .= $this -> toScreenSet($value);
                } else {
                    $this -> pgsql -> values .= $this -> toScreenSet($value) . ', ';
                }
            }
        } else {
            $this -> pgsql -> values .= $this->toScreenSet($values);
        }
        return $this;
    }

    public function where($condition) {
        $sql = '';
        if (gettype($condition) == 'array' && gettype(reset($condition)) == 'array') {
            foreach ($condition as $key => $value) {
                $sql .= $this -> toScreenWhere($value);
            }
        } else {
            $sql = $this -> toScreenWhere($condition);
        }
        $this-> pgsql -> where = $sql;
        return $this;
    }

    public function toScreenSet($values) {
        $sql = '';
        foreach ($values as $key => $value) {
            if (count($values)-1 == $key) {
                if ($value[0] == ':') {
                    $sql .= $key . '=' . substr($value, 1) . ' ';
                }
            } else {
                $sql .= $key . '=' . '\'' .$value . '\',';
            }
        }
        return $sql;
    }

    public function toScreenWhere($values) {
        $sql = '';
        foreach ($values as $key => $value) {
            if (($key == 0 && $value == 'AND') || ($key == 0 && $value == 'OR') || ($key == 0 && $value == 'and') || ($key == 0 && $value == 'or')) {
                $sql .= $value . ' ';
            } else {
                if ($value[0] == ':') {
                    $sql .= $key . '=' . $value . ' ';
                }
                $sql .= $key . '=' . '\'' . $value . '\' ';
            }
        }
        return $sql;
    }

    public function getUpdateText() {
        $sql = 'UPDATE ' . $this -> pgsql -> table . ' SET ' . $this -> pgsql -> values;
        if (!empty($this -> pgsql -> where)) {
            $sql .= ' WHERE ' . $this -> pgsql -> where;
        }
        return $sql;
    }
    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

}
