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
        $sql = 'select p.* from roles_privileges as rp join privileges p on p.id=rp.privilege_id whererp.role_id='.$roleId;
        $res = $this-> db-> selectQuery($sql);
        $out = [];
        foreach ($res as $item) {
            $out[$item['id']] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'code' => $item['code']
            ];
        }
    }
    public function roleInfoById($id){
        $role= $this-> roleById($id);
        if(isset($role['id'])){
            $role['privileges'] = $this-> privilegesByRole->$role['id'];
        }
        return $role;
    }
}