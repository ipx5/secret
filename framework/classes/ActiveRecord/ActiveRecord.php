<?php

class ActiveRecord {
    public static $config = false;
    protected static $db = false;
    protected static $tableName;
    private function __construct() {}
    private function __wakeup() {}
    private function __clone(){}

    public static function setConfig($tableName, $config, $connection) {
        self::$tableName = $tableName;
        self::$config = $config;
        self::$db = $connection;
        app::getInstance()->printTest($config);
        return new self();
    }

    public function __call($name, $arguments) {
        $method = substr($name, 0, 3);
        $column = substr($name, 3);
        $success = false;
        foreach (self::$config as $key => $value) {
            if (strtolower($key) === strtolower($column)) {
                $column = $key;
                $success = true;
            }
        }
        if (!$success) {
            throw new dbException('Нет колонки');
        }
        return $this -> $method($column, $arguments);
    }

    public function set($name, $arguments) {
        self::$config[$name]['value'] = reset($arguments);
        return $this;
    }

    public function get($name) {
        return self::$config[$name]['value'];
    }

    public function save() {
        if (!empty(self::$config['id']['value'])) {
            $this -> update();
        } else {
            $this -> insert();
        }
    }

    public function update() {
        $newArr = self::$config;
        unset($newArr['id']);
        $result = [];
        foreach ($newArr as $key => $value) {
            $result[$key] = $value['value'];
        }
        self::$db -> queryBuilder('update') -> table(self::$tableName) ->
        set($result)-> where(['id' => self::$config['id']['value']]) ->query();
    }

    public function insert() {
        $newArr = self::$config;
        unset($newArr['id']);
        $values = [];
        foreach ($newArr as $key => $value) {
            if ($newArr[$key]['value']) {
                $values[] = $newArr[$key]['value'];
            }
        }
        $result = self::$db -> queryBuilder('insert') -> insert(self::$tableName) -> columns(array_keys($newArr))
            -> values($values) -> returning(['id']) -> query();
        $row = pg_fetch_row($result);
        $new_id = $row[0];
        self::$config['id']['value'] = $new_id;
    }

    public function delete($aId) {
        $array = [];
        if (is_array($aId)) {
            foreach ($aId as $key => $value) {
                if (count($array) != 0) {
                    $array[] = ['OR'];
                    $array[] = ['id' => $value];
                } else {
                    $array[] = ['id' => $value];
                }
            }
            self::$db -> queryBuilder('delete') -> from(self::$tableName) -> where($array) -> query();
        } else {
            self::$db -> queryBuilder('delete') -> from(self::$tableName) -> where(['id' => $aId]) -> query();
        }
    }

    public function newInstance($aId) {
        $result = self::$db -> queryBuilder('select') -> select('*') -> from(self::$tableName) -> where(['id' => $aId]) -> limit(1) -> query();
        $row = reset($result);
        if ($row != false) {
            $element = new self();
            print_r($element::$config);
            foreach ($element::$config as $key => $value) {
                $element::$config[$key]['value'] = $row[$key];
            }
            return $element;
        } else {
            return false;
        }
    }

    public function select($limit = 0, $offset = 0) {
        $result = self::$db -> queryBuilder('select') -> select('*') -> from(self::$tableName) -> limit($limit) -> offset($offset) -> query();
        app::getInstance()->printTest($result);
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
}
