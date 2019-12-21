<?php
session_start();
?>
<h1>ログイン完了</h1>

<hr>

ユーザー: 
<?php 
echo ($_SESSION['user_login_name']);
?>

 でログイン完了しました。<br>
<a href="/index.php">掲示板に戻る</a>
