<?php


class User {

    public static $db = 2;

    public static function newEmptyInstance() {

        self::$db = new Pgsql(app::getInstance()->db['local']);
        return new self();
    }

    private function __construct(){}

    private $id;
    private $email;
    private $salt;
    private $token;
    private $tmp_token;
    private $admin;
    private $role_id;
    private $status;

    public function getId() {
        return $this -> id;
    }

    public function setEmail($aEmail) {
        $this -> email = $aEmail;
    }

    public function getEmail() {
        return $this -> email;
    }

    public function setSalt($aSalt) {
        $this -> salt = $aSalt;
    }

    public function getSalt() {
        return $this -> salt;
    }

    public function setToken($aToken) {
        $this -> email = $aToken;
    }

    public function getToken() {
        return $this -> token;
    }

    public function setTmpToken($aTmpToken) {
        $this -> tmp_token = $aTmpToken;
    }

    public function getTmpToken() {
        return $this -> tmp_token;
    }

    public function setAdmin($aAdmin) {
        $this -> admin = $aAdmin;
    }

    public function getAdmin() {
        return $this -> admin;
    }

    public function setRoleId($aRoleId) {
        $this -> role_id = $aRoleId;
    }

    public function getRoleId() {
        return $this -> role_id;
    }

    public function setStatus($aStatus) {
        $this -> status = $aStatus;
    }

    public function getStatus() {
        return $this -> status;
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
            ['salt' => $this->salt ?? ''],
            ['token' => $this->token ?? ''],
            ['tmp_token' => $this->tmp_token ?? ''],
            ['admin' => $this->admin ?? '0'],
            ['role_id' => $this->role_id ?? '0'],
            ['status' => $this->status ?? '1']
            ])-> where(['id' => $this->id]) ->query();
    }

    public function _insert() {
        $new_id = self::$db -> queryBuilder('insert') -> insert('users') -> columns(['email', 'salt', 'token', 'tmp_token', 'admin', 'role_id', 'status'])
            -> values([$this->email ?? '', $this->salt ?? '', $this->token ?? '', $this->tmp_token ?? '', $this->admin ?? '0', $this->role_id ?? '0', $this->status ?? '1', 'RETURNING id']) -> query();
        $this->id = $new_id;
    }
}