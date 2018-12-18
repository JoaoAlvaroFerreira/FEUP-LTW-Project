<?php

$dbh = new PDO('sqlite:../database/database.db');


$stmt = $dbh->prepare('SELECT * FROM users');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['username'], "|";
    echo $row['passw'], "|";
    echo $row['profileimg'], "|";
    echo $row['email'], "|";
    echo $row['description'], "|";
    echo $row['dateofbirth'], "|";
    echo $row['dataRegistered'], " ";
}

echo "  ";
$stmt = $dbh->prepare('SELECT * FROM posts');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['postID'], "|";
    echo $row['title'], "|";
    echo $row['content'], "|";
    echo $row['type'], "|";
    echo $row['dateWritten'], "|";
    echo $row['username'], " ";
}

echo "  ";
$stmt = $dbh->prepare('SELECT * FROM comments');
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row['commentID'], "|";
    echo $row['content'], "|";
    echo $row['dateWritten'], "|";
    echo $row['postID'], "|";
    echo $row['username'], "|";
    echo $row['fatherID'], " ";
}


 /*echo "  ";	 echo "  ";
 $stmt = $dbh->prepare('SELECT * FROM votes');	 $stmt = $dbh->prepare('SELECT * FROM commentvotes');
 $stmt->execute();	 $stmt->execute();
 $result = $stmt->fetchAll();	 $result = $stmt->fetchAll();
 foreach ($result as $row) {	 foreach ($result as $row) {
     echo $row['commentID'], "|";	     echo $row['commentID'], "|";
     echo $row['username'], "|";	     echo $row['username'], "|";
     echo $row['positive'], " ";	     echo $row['positive'], " ";
 }	 }
 */	 
 echo "  ";
 $stmt = $dbh->prepare('SELECT * FROM postvotes');
 $stmt->execute();
 $result = $stmt->fetchAll();
 foreach ($result as $row) {
     echo $row['postID'], "|";
     echo $row['username'], "|";
     echo $row['positive'], " ";
 }
 