<div class="error">
<?php echo $error ?? '';?>
</div>
<form method="POST" action="/user/authorization/">
    <input type="hidden" name="sub_token" value="<?php echo $sub_token ?? ''; ?>" >
    <table>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
    </table>
    <input type="submit" name="send">
</form>
<br />
<a href="/user/restore"> Забыли пароль? </a>