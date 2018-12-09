<?php

$dbh = new PDO('sqlite:../database/database.db');


$stmt = $dbh->prepare('SELECT * FROM users');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['username'], "|";
    echo $row['passw'], "|";
    echo $row['dataRegistered'], "<br>";
}

echo "<br><br>";
$stmt = $dbh->prepare('SELECT * FROM posts');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['postID'], "|";
    echo $row['title'], "|";
    echo $row['content'], "|";
    echo $row['link'], "|";
    echo $row['image'], "|";
    echo $row['dateWritten'], "|";
    echo $row['username'], "<br>";
}

echo "<br><br>";
$stmt = $dbh->prepare('SELECT * FROM comments');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['commentID'], "|";
    echo $row['content'], "|";
    echo $row['dateWritten'], "|";
    echo $row['postID'], "<br>";
}

echo "<br><br>";
$stmt = $dbh->prepare('SELECT * FROM votes');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['commentID'], "|";
    echo $row['username'], "|";
    echo $row['positive'], "<br>";
}

?>