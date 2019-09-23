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
        $columnsIsArray = is_array($columns);
        $sql = '';
        if ($columnsIsArray && is_array(reset($columns))) {
            foreach ($columns as $value) {
                foreach ($value as $key => $val) {
                    if ($sql === '') {
                        $sql .= $key . ' ' . $val;
                    } else {
                        $sql .= ', ' . $key . ' ' . $val;
                    }
                }
            }
            $this -> pgsql -> columns = $sql;
        } else if ($columnsIsArray) {
            foreach ($columns as $key => $value) {
                $keyIsString = is_string($key);
                if ($sql === '') {
                    if (!$keyIsString) {
                        $sql .= $value;
                    } else {
                        $sql .= $key . ' ' . $value;
                    }
                } else {
                    if (!$keyIsString) {
                        $sql .= ', ' . $value;
                    } else {
                        $sql .= ', ' . $key . ' ' . $value;
                    }
                }
            }
            $this -> pgsql -> columns = $sql;
        } else if (is_string($columns)) {
            $this -> pgsql -> columns = $columns;
        } else {
            throw new DbException(404, 'Invalid term select');
        }
        return $this;
    }

    public function from($tableName) {
        if (!is_string($tableName) && !is_array($tableName)) {
            throw new DbException(404, 'Invalid format table(Select)');
        }
        if (is_array($tableName)) {
            $keyName = key($tableName);
            $tableName = $keyName . ' ' . $tableName[$keyName];
        }
        $this-> pgsql -> table = $tableName;
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

    public function join($type = '', $table, $params) {
        if (!is_array($table) && !is_string($table)) {
            throw new DbException(404, 'Invalid format join');
        }
        $sql = '';
        if ($type === strtoupper($type)) {
            $typeJoin = 'JOIN';
        } else {
            $typeJoin = strtoupper($type) . ' JOIN';
        }
        if (is_array($table)) {
            $keyTable = key($table);
            $table = $keyTable . ' ' . $table[$keyTable];
        }
        $termJoin = '';
        if (is_array($params)) {
            $sign = '=';
            foreach ($params as $key=>$value) {
                $keyIsString = is_string($key);
                if ($keyIsString) {
                    $termJoin .= $key . $sign . $value;
                    $sign = '=';
                } elseif ($value === '!') {
                    $sign = '!=';
                } elseif ($value === 'AND' || $value === 'OR') {
                    $termJoin .= ' ' . $value . ' ';
                    $sign = '=';
                }
            }
        } elseif (is_string($params)) {
            $termJoin .= $params;
        } else {
            throw new DbException(404, 'Invalid format join');
        }
        $this -> pgsql -> join = $typeJoin . ' ' . $table . ' ON ' . $termJoin;
        return $this;
    }

    public function getSelectText() {
        if (empty($this -> pgsql -> columns) || empty($this -> pgsql -> table)) {
            throw new DbException(404, 'Invalid query Select. Please, check the entered data');
        }
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