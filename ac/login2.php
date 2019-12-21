<?php
// ログイン名とパスワードが期待したものでない場合はフォームに戻す
if( empty($_POST['login_name']) || empty($_POST['password'])
    || strlen($_POST['login_name']) < 3 || strlen($_POST['login_name']) > 20
    || strlen($_POST['password']) < 6 || strlen($_POST['password']) > 100
) { 
  header("HTTP/1.1 302 Found");
  header("Location: ./login_form.php?error=1");
  return;
}
// 接続 ref. https://www.php.net/manual/ja/pdo.connections.php
$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');
$select_sth = $dbh->prepare('SELECT id, login_name, password, created_at FROM user WHERE login_name = :login_name');
$select_sth->execute(['login_name' => $_POST['login_name']]);
$rows = $select_sth->fetchAll();
if (empty($rows)) {
  // ログイン名が正しくない場合
  header("HTTP/1.1 302 Found");
  header("Location: ./login_form.php?error=1");
  return;
}
$user = $rows[0];
if (!password_verify($_POST['password'], $user["password"])) {
  // パスワードが正しくない場合
  header("HTTP/1.1 302 Found");
  header("Location: ./login_form.php?error=1");
  return;
}
// セッション開始
session_start();
// セッションパラメータ user_login_name にユーザー名格納
$_SESSION['user_login_name'] = $user["login_name"];
// ログイン完了
header("HTTP/1.1 303 See Other");
header("Location: ./login_fin.php");
?>
