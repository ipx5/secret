<?php 
header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class roles extends Model {
    public function rolesList() {
        return $this-> db -> queryBuilder('select')-> select('*')-> from('role')-> query();
    }
    public function privilegesList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('privilege')-> query();
    }
    public function roleById($id){
        if(!preg_match('#[0-9]*#', $id)){
            throw new httpException(404, 'Invalid role id' . $id);
        }
        $role = $this-> db -> queryBuilder('select')-> select('*')-> from('role')-> where(['id' => $id])-> query();
        return empty($role) ? [] : reset($role);
    }
    public function privilegesByRole($roleId){
        if(!preg_match('#[0-9]*#', $roleId)){
            throw new httpException(404, 'Invalid role id' . $roleId);
        }
        //debug($roleId);
        $sql = 'select p.* from roles_privileges as rp join privileges p on p.id=rp.privilege_id where rp.role_id='.$roleId.';';
        $res = $this-> db-> selectQuery($sql);
        //debug($res);
        $out = [];
        foreach ($res as $item) {
            $out[$item['id']] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'code' => $item['code']
            ];
        }
        return $out;
    }
    public function roleInfoById($id){
        $role= $this-> roleById($id);
        //debug($role);
        if(isset($role['id'])){
            $role['privileges'] = $this-> privilegesByRole($role['id']);
        }
        return $role;
    }
    public function saveRole($role){
        if(isset($role['id']) && $role['id']){
            return $this->updateRole($role);
        } else {
            return $this-> createRole($role);
        }
    }

    public function createRole($role){
        $privileges = $role['privilege'];
        unset($role['id'], $role['privilege']);
        $this-> db-> queryBuilder('insert')-> insert('role')-> columns(['name'])-> values([$role['name']])-> query();
        $id = $this-> db-> queryBuilder('select')-> select('id')-> from('role')-> where(['name'=> $role['name']])-> query();; 
        $id = reset($id);
        $id = $id['id'];
        foreach ($privileges as $priv) {
            $this-> db-> queryBuilder('insert')-> insert('roles_privileges') -> columns(['role_id', 'privilege_id']) -> values([$id, $priv]) -> query();
        }
    }
    protected function updateRole($role){
        $id = $role['id'];
        $privileges = $role['privilege'] ?? [];
        unset($role['id'], $role['privilege']);
        $this-> db-> queryBuilder('update')-> table('role')-> set(['name'=> $role['name']])-> where(['id'=> $id])-> query();
        $this-> db-> queryBuilder('delete')-> from('role_privilege')-> where(['role_id'=> $id])-> query();
        foreach ($privileges as $priv) {
            $this-> db-> queryBuilder('insert')-> insert('role_privilege') -> columns(['role_id', 'privilege_id']) -> values([$id, $priv]) -> query();
        }
        
    }
}