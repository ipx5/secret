<?php


class User1 {

    public static $db;

    public static function newEmptyInstance() {
        self::$db = new Pgsql(app::getInstance()->db['local']);
        return new self();
    }

    private function __construct(){}

    public $id;
    public $email;
    public $password;
    public $salt;
    public $token;
    public $sub_token;
    public $admin;
    public $role_id;
    public $status;

    protected function set($name, $arguments) {
        $resetArgument = reset($arguments);
        $this -> $name = $resetArgument;
        return false;
    }

    public function __call($name, $arguments) {
        $method = substr($name, 0, 3);
        $name = strtolower(substr($name, 3));
        if ($method == 'get' || $method == 'set' || !empty($this -> $name)) {
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

    public function get($name, $arguments = []) {
        return $this -> $name;
    }

    public function save() {
        if (isset($this -> id)) {
            $this -> _update();
        } else {
            $this -> _insert();
        }
    }

    public function _update() {
        self::$db -> queryBuilder('update') -> table('users') ->
        set([
            ['id' => $this -> id ?? ''],
            ['email' => $this -> email ?? ''],
            ['password' => $this -> password ?? ''],
            ['salt' => $this->salt ?? ''],
            ['token' => $this->token ?? ''],
            ['sub_token' => $this->sub_token ?? ''],
            ['admin' => $this->admin ?? '0'],
            ['role_id' => $this->role_id ?? '0'],
            ['status' => $this->status ?? '1']
            ])-> where(['id' => $this->id]) ->query();
    }

    public function _insert() {
        $new_id = self::$db -> queryBuilder('insert') -> insert('users') -> columns(['email', 'salt', 'token', 'sub_token', 'admin', 'role_id', 'status', 'password'])
            -> values([$this->email ?? '', $this->salt ?? '', $this->token ?? '', $this->sub_token ?? '', $this -> password ?? '', $this->admin ?? '0', $this->role_id ?? '0', $this->status ?? '1', 'RETURNING id']) -> query();
        $this->id = $new_id;
    }

    public static function _delete($aId) {
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
            self::$db -> queryBuilder('delete') -> from('users') -> where($array) -> query();
        } else {
            self::$db -> queryBuilder('delete') -> from('users') -> where(['id' => $aId]) -> query();
        }
    }

    public static function select($limit = 0, $offset = 0) {
        $result = self::$db -> queryBuilder('select') -> select('*') -> from('users') -> limit($limit) -> offset($offset) -> query();
        if ($result != false) {
            $arrayUsers = [];
            foreach ($result as $value) {
                $arrayUsers[] = self::newInstance($value['id']);
            }
            return $arrayUsers;
        } else {
            return false;
        }
    }

    public static function newInstance($aId) {
        $result = self::$db -> queryBuilder('select') -> select('*') -> from('users') -> where(['id' => $aId]) -> limit(1) -> query();
        $row = reset($result);
        if ($row != false) {
            $product = new self();
            $product -> id = $row['id'];
            $product -> email = $row['email'];
            $product -> password = $row['password'];
            $product -> salt = $row['salt'];
            $product -> token = $row['token'];
            $product -> sub_token = $row['sub_token'];
            $product -> admin = $row['admin'];
            $product -> role_id = $row['role_id'];
            $product -> status = $row['status'];
            return $product;
        } else {
            return false;
        }
    }
}