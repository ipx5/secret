<?php

interface InsertBehavior {
    public function insert($tableName);
    public function columns($columns);
    public function values($values);
    public function toScreen($values);
    public function getInsertText();
}

class Insert implements InsertBehavior  {
    protected $pgsql;

    public function __construct($object) {
        $this -> pgsql = $object;
    }

    public function insert($tableName) {
        $this->pgsql->table = $tableName;
        return $this;
    }
    public function columns($columns) {
        if (gettype($columns) == 'array' && count($columns) > 1) {
            $this -> pgsql -> columns = implode(',', $columns);
        } else {
            $this -> pgsql -> columns = $columns;
        };
        return $this;
    }

    public function values($values) {
        if (gettype(reset($values)) == 'array') {
            foreach ($values as $key => $value) {
                if (count($values)-1 == $key) {
                    $this -> pgsql -> values .= $this -> toScreen($value);
                } else {
                    $this -> pgsql -> values .= $this -> toScreen($value) . ', ';
                }
            }
        } else {
            $this -> pgsql -> values .= $this->toScreen($values);
        }
        return $this;
    }

    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

    public function toScreen($values) {
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

    public function getInsertText() {
        return 'INSERT INTO ' . $this -> pgsql -> table  . (($this -> pgsql -> columns) ? ' (' . ($this -> pgsql -> columns) . ') ' : '')  . ' VALUES ' . $this -> pgsql -> values;
    }

}