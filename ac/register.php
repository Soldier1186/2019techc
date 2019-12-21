<?php
// ログイン名とパスワードが期待したものでない場合はフォームに戻す
if( empty($_POST['login_name']) || empty($_POST['password'])
    || strlen($_POST['login_name']) < 3 || strlen($_POST['login_name']) > 20
    || strlen($_POST['password']) < 6 || strlen($_POST['password']) > 100
) { 
  header("HTTP/1.1 302 Found");
  header("Location: ./register_form.php?error=1");
  return;
}
$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');
$select_sth = $dbh->prepare('SELECT COUNT(id) FROM user WHERE login_name = :login_name');
$select_sth->execute(['login_name' => $_POST['login_name']]);
$rows = $select_sth->fetchAll();
if ($rows[0][0] !== "0") {
  // 同じログインIDのユーザーが既にある場合はフォームに戻す
  header("HTTP/1.1 302 Found");
  header("Location: ./register_form.php?error=2");
  return;
}
// パスワードのハッシュ化
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// INSERTする
$insert_sth = $dbh->prepare("INSERT INTO user (login_name, password) VALUES (:login_name, :password)");
$insert_sth->execute(array(
    ':login_name' => $_POST['login_name'],
    ':password' => $password,
));
// 投稿が完了したので閲覧画面に飛ばす
header("HTTP/1.1 303 See Other");
header("Location: ./register_fin.php");
?>
