<a href="/role/edit"> Создать роль</a><br/>
<table>
    <?php foreach ($roles as $role) { ?>
        <tr>
        <td><a href="/role/edit/?id=<?php echo  $role['id']; ?>"> Редактировать</a></td>
        <td><a href="/role/delete/?id=<?php echo  $role['id']; ?>"> Удалить</a></td>
        <td><?php echo $role['name']; ?></td>
        </tr>
    <?php } ?>
</table>