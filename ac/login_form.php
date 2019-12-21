<h1>ログインフォーム</h1>

<hr>
会員登録は<a href="./register_form.php">こちら</a>。
<hr>

<?php
if ($_GET['error'] === "1") {
    print("ログインに失敗しました。正しいログイン名とパスワードを入力してください。");
}
?>

<form method="POST" action="./login2.php">
    <div>
        ログイン名(ログインID): <input type="text" name="login_name" minlength="3" maxlength="20">
    </div>
    <div>
        パスワード: <input type="password" name="password" minlength="6" maxlength="100">
    </div> 
    <input type="submit" value="ログイン">
</form> 
