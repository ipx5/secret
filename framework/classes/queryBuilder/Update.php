<?php


interface UpdateBehavior {
    public function table($tableName);
    public function set($values);
    public function getUpdateText();
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
        $chunkQuery = '';
        $typeValues = is_array(reset($values));
        if ($typeValues) {
            foreach ($values as $key => $value) {
                if ($chunkQuery === '') {
                    $chunkQuery .= $this -> pgsql -> toScreen($value);
                } else {
                    $chunkQuery .= ',' . $this -> pgsql -> toScreen($value);
                }
            }
        } else {
            $chunkQuery .= $this -> pgsql -> toScreen($values, ',');
        }
        $this -> pgsql -> values = $chunkQuery;
        return $this;
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
