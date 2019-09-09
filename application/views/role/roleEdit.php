<div class="error">
    <?php echo $error ?? ''; ?>
</div>
<form action="/role/edit" method="POST">
    <input type="hidden" name="id" value="<?php echo $role['id'] ?? 0; ?>">
    Имя роли: <input type="text" name="name" value="<?php echo $role['name'] ?? ''; ?>"><br/>
    <?php foreach ($privileges as $privilege) { ?>
        <?php echo $privilege['name']; ?>
        <input type="checkbox" name="privilege[]" value="<?php echo $privilege['id']; ?>" <?php echo isset($role['privileges'][$privilege['id']]) ? ' checked="checked"':''?>><br/>
    <?php } ?>
    <input type="submit" name="send" />
</form>