<?php
$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');

session_start();

if (!empty($_SESSION['id']))
{
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$name = $_POST['name'];
	$password = $_POST['password'];
	$errors = array();

	if ($name == '')  // もしnameが空だったら
    {
        $errors['name'] = '※ ユーザネームが未入力です';
    }
    if ($password == '')  
    {
        $errors['password'] = '※ パスワードが未入力です';
    }
    // バリデーション突破後
    if (empty($errors))  // $errorsが空だったら(=エラーが無かったら)
    {
        $sql = 'SELECT password FROM users WHERE name = :name;';  // テーブルの中に該当レコードがあるか
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":name", $_POST['name']);
        $sth->execute();
        $row = $sth->fetch();  // レコードの取り出し
        // var_dump($row);
    if ($row)  // 該当レコードがあったら
    {
        $_SESSION['id'] = $row['id'];  // セッションのidにレコードのidを持たせる
        $_SESSION['name'] = $row['name'];
        header('Location: index.php');  // index.phpに飛ばす
        exit;
    }
    else  // もし該当レコードがなかったら
    {
        echo 'ユーザネームかパスワードが間違っています';
    }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログイン画面</title>
    </head>
    <body>
        <h1>ログイン</h1>
        <form aciton="" method="post">
            <p>
            ユーザネーム: <input type="text" name="name">
            <?php if ($errors['name']) : ?>
                <?php echo h($errors['name']) ?>
            <?php endif ?>
            </p>
            <p>
            パスワード: <input type="password" name="password">
            <?php if ($errors['password']) : ?>
                <?php echo h($errors['password']) ?>
            <?php endif ?>
            </p>
            <input type="submit" value="ログイン">
        </form>
        <a href="edit.php">新規登録はこちら!</a>
    </body>
</html>
