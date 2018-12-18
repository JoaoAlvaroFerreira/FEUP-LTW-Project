<?php
  include_once('init.php');

  function insertPost($title, $type, $content, $username, $channel) {
    $db = Database::getInstance()->db();
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare('INSERT INTO posts VALUES(NULL,?, ?, ?, ?, ?,?)');
    $stmt->execute(array($title,$content,$type,$date,$username,$channel));
      
    return true;
  }

    function insertComment($content,$postID, $username, $fatherID) {
    $db = Database::getInstance()->db();
    echo $fatherID;
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare('INSERT INTO comments VALUES(NULL,?, ?, ?, ?, ?)');
    $stmt->execute(array($content,$date,$postID,$username,$fatherID));

    return true;
    }

    

    function deletePost($id){
        
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('DELETE FROM posts WHERE postID=?');
    $stmt->execute(array($id));
      
    return true;
        
    }

function deleteComment($id){
        
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('DELETE FROM comments WHERE commentID=?');
    $stmt->execute(array($id));
    echo $id;
      
    return true;
        
    }
?>