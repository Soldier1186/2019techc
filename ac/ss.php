<?php
session_start();

if( empty($_POST['body']) || empty($_SESSION['user_login_name'])) {
  header("HTTP/1.1 302 Found");
  header("Location: ./index.php");
  return;
}

$filename = null;
if ($_FILES['upload_image']['size'] > 0) {
    if (exif_imagetype($_FILES['upload_image']['tmp_name'])) {
        $ext = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . "." . $ext;
        $filepath = "/src/2019techc/ac/static/images/" . $filename;
        move_uploaded_file($_FILES['upload_image']['tmp_name'], $filepath);
    }
}


$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');



// INSERTする
$insert_sth = $dbh->prepare("INSERT INTO bbs (name, body, filename) VALUES (:name, :body, :filename)");
$insert_sth->execute(array(
    ':name' => $_POST['user_login_name'],
    ':body' => $_POST['body'],
    ':filename' => $filename,
));




// 投稿が完了したので閲覧画面に飛ばす
header("HTTP/1.1 303 See Other");
header("Location: ./index.php");
?>
