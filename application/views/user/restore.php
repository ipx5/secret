<div class="error">
<?php echo $error ?? '';?>
</div>
<form method="POST" action="/user/restore/">
<input type="hidden" name="sub_token" value="<?php echo $sub_token ?? ''; ?>" >
    <table>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Retype password</td>
            <td><input type="password" name="repassword"/></td>
        </tr>
    </table>
    <input type="submit" name="send">
</form>