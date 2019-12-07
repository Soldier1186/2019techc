<?php
$dbh = new PDO('mysql:host=database-1.c6bncgbidtab.us-east-1.rds.amazonaws.com;dbname=keijiban','Oha','password');

$name = 'profile_top';

$select_sth = $dbh->prepare('SELECT id, name, count FROM counter WHERE name = :name LIMIT 1');
$select_sth->execute(array(':name' => $name));
$result = $select_sth->fetch();

if(!$result) {
    $insert_sth = $dbh->prepare("INSERT INTO counter (name, count) VALUES (:name, 0)");
    $insert_sth->execute(array(':name' => $name));

    $select_sth->execute(array(':name' => $name));
    $result = $select_sth->fetch();
}

$result['count']++;

printf("あなたは%d人目の訪問者です", $result['count']);

$update_sth = $dbh->prepare("UPDATE counter SET count = :count WHERE id = :id");
$update_sth->execute(array(':id' => $result['id'], 'count' => $result['count']));
