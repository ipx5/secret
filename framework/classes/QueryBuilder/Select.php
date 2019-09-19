<?php


interface SelectInterface {
    public function select();
    public function from($table);
//    public function where($condition);
    public function getSelectText();
//    public function selectQuery($sql);
}

class Select implements SelectInterface {

    protected $pgsql;

    public function __construct($object) {
        $this -> pgsql = $object;
    }

    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

    public function select($columns = '*') {
        $sql = '';
        if (gettype($columns) == 'array') {
            foreach ($columns as $key => $value) {
                if ($sql === '') {
                    $sql .= key($value) . '.' . current($value);
                } else {
                    $sql .= ', ' . key($value) . '.' . current($value);
                }
            }
            $this -> pgsql -> columns = $sql;
        } else {
            $this -> pgsql -> columns = $columns;
        }
        return $this;
    }

    public function from($table) {
        $this-> pgsql -> table = $table;
        return $this;
    }

    public function limit($number) {
        $this -> pgsql -> limit = $number;
        return $this;
    }

    public function offset($number) {
        $this -> pgsql -> offset = $number;
        return $this;
    }

    public function orderBy($value) {
        $this -> pgsql -> orderBy = $value;
        return $this;
    }

    public function join($type, $table, $params = '') {
        $sql = $type . ' ' . $table . ' on ';
        $paramsSql = '';
        foreach ($params as $key => $value) {
            if ($value === '=') {
                $paramsSql .= $value;
            } else {
                $paramsSql .= $key . '.' . $value;
            }
        }
        $this -> pgsql -> join = $sql . $paramsSql;
        return $this;
    }

    public function getSelectText() {
        $sql = 'SELECT ' . $this->pgsql -> columns . ' FROM ' . $this-> pgsql -> table;

        if (!empty($this -> pgsql -> join)) {
            $sql .= ' ' . $this -> pgsql -> join;
        }

        if (!empty($this-> pgsql -> where)) {
            $sql .= ' WHERE ' . $this-> pgsql -> where;
        }

        if (!empty($this -> pgsql -> limit)) {
            $sql .= ' LIMIT ' . $this -> pgsql -> limit;
        }

        if (!empty($this -> pgsql -> offset)) {
            $sql .= ' OFFSET ' . $this -> pgsql -> offset;
        }

        if (!empty($this -> pgsql -> orderBy)) {
            $sql .= ' ORDER BY ' . $this -> pgsql -> orderBy;
        }
        return $sql;
    }

}