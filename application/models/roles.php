<?php 
class roles extends model {
    public function rolesList() {
        return $this-> db -> queryBuilder('select')-> select('*')-> from('roles')-> query();
    }
    public function privilegesList(){
        return $this-> db -> queryBuilder('select')-> select('*')-> from('privileges')-> query();
    }
    public function roleById($id){
        if(!preg_match('#[0-9]*#', $id)){
            throw new httpException(404, 'Invalid role id' . $id);
        }
        $role = $this-> db -> queryBuilder('select')-> select('*')-> from('roles')-> where(['id' => $id])-> query();
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
        $this-> db-> queryBuilder('insert')-> insert('roles')-> columns(['name'])-> values([$role])-> query();
        $id = $this-> db-> queryBuilder('select')-> select('id')-> from('roles')-> where(['name'=> $role['name']])-> query();; 
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
        $this-> db-> queryBuilder('update')-> table('roles')-> set(['name'=> $role['name']])-> where(['id'=> $id])-> query();
        $this-> db-> queryBuilder('delete')-> from('roles_privileges')-> where(['role_id'=> $id])-> query();
        foreach ($privileges as $priv) {
            $this-> db-> queryBuilder('insert')-> insert('roles_privileges') -> columns(['role_id', 'privilege_id']) -> values([$id, $priv]) -> query();
        }
        
    }
}