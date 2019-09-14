<?php


class Entity extends model {
    public $tableColumns;
    public $col;
    public $tableName;
    public function __construct($name, $columns) {
        parent::__construct();
        $this -> tableColumns = [];
        foreach ($columns as $key => $value) {
            if ($key === 'id') {
                $this -> tableColumns[$key] = false;
            } else if ($value == 'str') {
                $this -> tableColumns[$key] = '';
            } else {
                $this -> tableColumns[$key] = 0;
            }
        }
        $this -> col = $columns;
        $this -> tableName = $name;
    }

    public function __call($name, $arguments) {
        $method = substr($name, 0, 3);
        $name = strtolower(substr($name, 3));
        if ($method == 'get' || $method == 'set') {
            $value = $this -> $method($name, $arguments);
            if ($value) {
                return $value;
            } else {
                return $this;
            }
        } else {
            echo "Неверное имя функции";
            return;
        }
    }

    public function set($name, $arguments) {
        $this -> tableColumns[$name] = reset($arguments);
        return $this;
    }

    public function get($name, $arguments = []) {
        return $this -> tableColumns[$name];
    }

    public function save() {
        if (!empty($this -> tableColumns['id'])) {
            $this -> update();
        } else {
            $this -> insert();
        }
    }

    public function update() {
        $set = [];
        $this -> db -> queryBuilder('update') -> table($this -> tableName) ->
        set($this -> tableColumns)-> where(['id' => $this -> tableColumns['id']]) ->query();
    }

    public function insert() {
        $newArr = $this -> tableColumns;
        unset($newArr['id']);
        $new_id = $this -> db -> queryBuilder('insert') -> insert($this -> tableName) -> columns(array_keys($newArr))
            -> values($newArr) -> returning(['id']) -> query();
        $this -> tableColumns['id'] = $new_id;
    }

    public function delete($aId) {
        $array = [];
        if (gettype($aId) == 'array') {
            foreach ($aId as $key => $value) {
                if ($key == 0) {
                    $array[] = ['id' => $value];
                } else {
                    $array[] = ['OR'];
                    $array[] = ['id' => $value];
                }
            }
            $this -> db -> queryBuilder('delete') -> from($this -> tableName) -> where($array) -> query();
        } else {
            $this -> db -> queryBuilder('delete') -> from($this -> tableName) -> where(['id' => $aId]) -> query();
        }
    }

    public function select($limit = 0, $offset = 0) {
        $result = $this -> db -> queryBuilder('select') -> select('*') -> from($this -> tableName) -> limit($limit) -> offset($offset) -> query();
        if ($result != false) {
            $arrayUsers = [];
            foreach ($result as $value) {
                $arrayUsers[] = $this -> newInstance($value['id']);
            }
            return $arrayUsers;
        } else {
            return false;
        }
    }

    public function newInstance($aId) {
        $result = $this -> db -> queryBuilder('select') -> select('*') -> from($this -> tableName) -> where(['id' => $aId]) -> limit(1) -> query();
        $row = reset($result);
        if ($row != false) {
            $product = $this;
            foreach ($this -> tableColumns as $key => $value) {
                $product -> tableColumns[$key] = $row[$key];
            }
            return $product;
        } else {
            return false;
        }
    }
}