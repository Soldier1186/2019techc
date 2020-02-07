<?php
$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');

if($_POST['name'] != null && $_POST['password'] != null){
	$name     = $_POST['name'];
	$password = $_POST['password'];
	$sql = 'SELECT * FROM users WHERE name = :name';
	$stmt = $dbh->prepare($sql);
	$stmt->execute(:name => $name);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログイン画面</title>
    </head>
    <body>
        <h1>ログイン</h1>
        <form method="POST" action="login.php">
		ID:<input type="text" name ="name"><br />
		PW:<input type="text> name="password"><br />
		<input type="submit" value="ログイン">
	</form>
        <a href="edit.php">新規登録はこちら!</a>
    </body>
</html>
