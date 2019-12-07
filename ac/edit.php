<?php
$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $name = $_POST['name'];
    $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    var_dump($hash_password);
    $errors = array();  // バリデーションのエラーメッセージ
    // バリデーション
    if ($name == '')  // もしnameが空だったら
    {
        $errors['name'] = '※ ユーザネームが未入力です';
    }
    if ($hash_password == '')  
    {
        $errors['hash_password'] = '※ パスワードが未入力です';
    }
    if (empty($errors))  // $errorsが空だったら(=エラーが無かったら)
    {
	$sql = 'INSERT INTO users (name, password, created_at) VALUES(:name, :password, now())';
	$sth = $dbh->prepare($sql);
	$sth->bindParam(':name', $name);
	$sth->bindParam(':password', $hash_password);
	$sth->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>新規登録画面</title>
    </head>
    <body>
        <h1>新規登録</h1>
        <form aciton="" method="post">
            <p>
            ユーザネーム: <input type="text" name="name">
            <?php if ($errors['name']) : ?>
                <?php echo h($errors['name']) ?>
            <?php endif ?>
            </p>
            <p>
	    パスワード: <input type="text" name="password">
            <?php if ($errors['password']) : ?>
                <?php echo ($errors['password']) ?>
            <?php endif ?>
            </p>
            <input type="submit" value="登録する">
        </form>
        <a href="login.php">ログイン画面へ</a>
    </body>
</html>
