<?php
  include_once('init.php');

  function insertPost($title, $type, $content, $username) {
    $db = Database::getInstance()->db();
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare('INSERT INTO posts VALUES(NULL,?, ?, ?, ?, ?)');
    $stmt->execute(array($title,$content,$type,$date,$username));
      
    return true;
  }

    function insertComment($content,$postID, $username, $fatherID) {
    $db = Database::getInstance()->db();
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare('INSERT INTO comments VALUES(NULL,?, ?, ?, ?, ?)');
    $stmt->execute(array($content,$date,$postID,$username,$fatherID));

    return true;
    }
?>