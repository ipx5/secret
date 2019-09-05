<div class="error">
    <?php echo $error ?? ''; ?>
</div>
<form action="/role/edit" method="POST">
    <input type="hiden" name="id" value="<?php echo $role['id'] ?? 0; ?>"><br/>
    <?php foreach ($privileges as $privileges) { ?>
        <?php echo $privilege['name']; ?>
        <input type="checkbox" name="privilege[]" value="<?php echo $privilege['id']; ?>" <?php isset($role['privileges'][$privilege['id']]) ? ' checked="cheked"':''?>><br/>
    <?php } ?>
    <input type="submit" name="send" />
</form>