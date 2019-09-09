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
        $set = '';
        if (gettype(reset($values)) == 'array') {
            foreach ($values as $key => $value) {
                if ($set === '') {
                    $set .= $this -> toScreenSet($value);
                } else {
                    $set .= ', ' . $this -> toScreenSet($value);
                }
            }
        } else {
            $set .= $this -> toScreenSet($values);
        }
        $this -> pgsql -> values = $set;
        return $this;
    }

    public function where($condition) {
        $sql = '';
        $symbol = ', ';
        if (gettype(reset($condition)) == 'array') {
            foreach ($condition as $key => $value) {
                if ($sql === '') {
                    $sql .= $this -> toScreenWhere($value);
                }
                else {
                    $result = $this -> toScreenWhere($value);
                    if ($result === 'OR' || $result === 'AND') {
                        $symbol = ' ';
                        $sql .= $symbol . $result;
                    } else {
                        $sql .= $symbol . $result;
                        $symbol = ', ';
                    }
                }
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
            $type = gettype($value);
            if ($sql === '') {
                $sql .= $key .'=' . (($type == 'string') ? '\'' . $value . '\'' : $value);
            } else {
                $sql .= ',' . $key . '=' . (($type == 'string') ? '\'' . $value . '\'' : $value);
            }
        }
        return $sql;
    }

    public function toScreenWhere($values) {
        $sql = '';
        $term = '=';
        foreach ($values as $key => $value) {
            $type = gettype($value);
             if ($value === 'OR' || $value === 'AND') {
                $sql .= $value;
            } else if ($value === '!') {
                $term = '!=';
            } else if (substr($value, 0, 1) === ':' || $type === 'number') {
                 $sql .= ' ' . $key . $term . substr($value, 1);
             }
             else {
                $sql .= ' ' . $key . $term . (($type == 'string') ? '\'' . $value . '\'' : $value);
                $term = '=';
            }
        }
        return $sql;
    }

    public function getUpdateText() {
        $sql = 'UPDATE ' . $this -> pgsql -> table . ' SET ' . $this -> pgsql -> values;
        if (!empty($this -> pgsql -> where)) {
            $sql .= ' WHERE ' . $this -> pgsql -> where;
        }

        if (!empty($this -> pgsql -> returning)) {
            $sql .= ' RETURNING ' . $this -> pgsql -> returning;
        }
        return $sql;
    }

    public function returningColumn($params) {
        $columns = implode(", ", $params);
        $this -> pgsql -> returning = $columns;
        return $this;
    }

    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

}
