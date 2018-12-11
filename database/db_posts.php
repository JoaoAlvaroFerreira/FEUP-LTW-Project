<?php
  include_once('init.php');

  function insertPost() {
    $date = date('Y-m-d H:i:s');
    $db = Database::getInstance()->db();
    $title = $_POST['title'];
    $date = date('Y-m-d H:i:s');
    $username= $_SESSION['username'];
    $content = $_POST['content'];
    $stmt = $db->prepare('INSERT INTO posts VALUES(NULL,?, ?, NULL, ?, ?)');
    $stmt->execute(array($title,$content,$date,$username));
    include_once('test.php');
      
    return true;
  }
?>