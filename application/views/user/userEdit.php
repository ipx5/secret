<form action="/user/editUser" method="POST">

    <input type="hidden" name="id" value="<?php echo $user['id']  ??0; ?>">
    <h4><?php echo $user['email'].$user['is_admin'] ?? '';  ?><h4><br/>
    Админ: <input type="checkbox" <?php echo $user['is_admin']=='t' ? 'checked="checked"' : ''; ?> name="is_admin" value="1" /><br/><br/>
    <select name="role_id">
        <option value="0">Нет роли</option>
        <?php foreach ($roles as $role) { ?>
        <option <?php echo $user['role_id'] == $role['id'] ? 'selected="selected"':''; ?>value="<?php echo $role['id']; ?>"> <?php echo $role['name']; ?> </option>
        <?php } ?>
    </select><br/><br/>
    <input type="submit" name="send">
</form>