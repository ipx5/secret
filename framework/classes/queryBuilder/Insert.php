<?php

interface InsertBehavior {
    public function insert($tableName);
    public function columns($columns);
    public function values($values);
//    public function toScreen($values);
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
            $this -> pgsql -> columns = reset($columns);
        };
        return $this;
    }

    public function values($values) {
        $typeValue = is_array(reset($values));
        $chunkValues = '';
        if ($typeValue) {
            foreach ($values as $key => $value) {
                if ($chunkValues === '') {
                    $chunkValues .= '(' . $this -> pgsql -> toScreen($value, ',') . ')';
                } else {
                    $chunkValues .= ',' . '(' . $this -> pgsql -> toScreen($value, ',') . ')';
                }
            }
        } else {
            $chunkValues .= $this-> pgsql -> toScreen($values, ',');
        }
        $this -> pgsql -> values = $chunkValues;
        return $this;
    }

    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

    public function getInsertText() {
        $sql = 'INSERT INTO ' . $this -> pgsql -> table  . (($this -> pgsql -> columns) ? (' (' . ($this -> pgsql -> columns) . ') ') : '')  . ' VALUES ' . $this -> pgsql -> values . ' '.  ( $this -> pgsql -> returning ?? '');
        echo $sql;
        die(' END');
        return $sql;
    }

}