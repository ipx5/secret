<div class="error">
<?php echo $error ?? '';?>
</div>
<form method="POST" action="/user/registration/">
    <table>
        <tr>
            <td>Email</td>
            <td><input type="email" value="<?php echo $email ?? ''?>" name="email"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" value="<?php echo $password ?? ''?>" name="password"></td>
        </tr>
        <tr>
            <td>Retype password</td>
            <td><input type="password" value="<?php echo $repassword ?? ''?>" name="repassword"/></td>
        </tr>
    </table>
    <input type="submit" name="send">
</form>