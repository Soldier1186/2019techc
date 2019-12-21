<h1>登録フォーム</h1>

<hr>

<?php
if ($_GET['error'] === "2") {
    print("既に同じログイン名のユーザーが存在します。別のログイン名を入力してください。");
}
?>

<form method="POST" action="./register.php" enctype="multipart/form-data">
    <div>
        ログイン名(ログインID): <input type="text" name="login_name" minlength="3" maxlength="20">
    </div>
    <div>
        パスワード: <input type="password" name="password" minlength="6" maxlength="100">
    </div> 
    <input type="submit" value="登録">
</form> 
