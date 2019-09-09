<table>
    <?php foreach ($users as $user) { ?>
        <tr>
        <td><a href="/user/editUser/?id=<?php echo  $user['id']; ?>"> Редактировать</a></td>

        <td><?php echo $user['email']; ?></td>
        </tr>
    <?php } ?>
</table>