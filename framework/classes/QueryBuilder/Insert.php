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
        if (!is_string($tableName)) {
            throw new DbException(404, 'Invalid format table(Insert)');
        }
        $this->pgsql->table = $tableName;
        return $this;
    }
    public function columns($columns) {
        $columnsIsArray = is_array($columns);
        if ($columnsIsArray && count($columns) > 1) {
            $this -> pgsql -> columns = implode(',', $columns);
        } elseif (is_string($columns)) {
            $this -> pgsql -> columns = reset($columns);
        } else {
            throw new DbException(404, 'Input the correct data in columns(Array or string)');
        };
        return $this;
    }

    public function values($values) {
        if (!is_array($values)) {
            throw new DbException(404, 'Input the correct data in values(Array)');
        }
        $typeValue = is_array(reset($values));
        $chunkValues = '';
        if ($typeValue) {
            foreach ($values as $key => $value) {
                if ($chunkValues === '') {
                    $chunkValues .= '(' . $this -> toScreenValues($value) . ')';
                } else {
                    $chunkValues .= ',' . '(' . $this -> toScreenValues($value) . ')';
                }
            }
        } else {
            $chunkValues .= '(' . $this -> toScreenValues($values) . ')';
        }
        $this -> pgsql -> values = $chunkValues;
        return $this;
    }

    public function __call($name, $params) {
        return $this -> pgsql -> $name(reset($params));
    }

    public function returning($params) {
        if (is_array($params)) {
            $columnsReturning = implode(", ", $params);
        } elseif (is_string($params)) {
            $columnsReturning = $params;
        } else {
            throw new DbException(404, 'Input the correct data in returning(Array or string)');
        }
        $this -> pgsql -> returning = $columnsReturning;
        return $this;
    }

    public function getInsertText() {
        if (empty($this -> pgsql -> table)) {
            throw new DbException(404, 'Invalid query Insert. Please, check the entered data');
        }
        $sql = 'INSERT INTO ' . $this -> pgsql -> table  . (($this -> pgsql -> columns) ? (' (' . ($this -> pgsql -> columns) . ') ') : '')  . ' VALUES ' . $this -> pgsql -> values . ' '.  ( $this -> pgsql -> returning ? ' RETURNING ' . $this -> pgsql -> returning : '');
        return $sql;
    }

    public function toScreenValues($values) {
        $result = '';
        foreach ($values as $key => $value) {
            if ($result === '') {
                if (is_string($value)) {
                    $result .= ' \'' .  $value .'\'';
                } else {
                    $result .= $value;
                }
            } else if (is_string($value)) {
                $result .= ', \'' .  $value . '\'';
            } else {
                $result .= ', ' . $value;
            }
        }
        return $result;
    }

}