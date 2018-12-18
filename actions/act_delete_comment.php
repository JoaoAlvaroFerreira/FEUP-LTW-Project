<?php
  include_once('../database/db_posts.php');
  include_once ('../database/session.php');


$id = htmlspecialchars($_POST['id']);


    
    $db = Database::getInstance()->db();
    $stmt = $db->prepare('SELECT * FROM comments WHERE commentID=?');
    $stmt->execute(array($id));
    $result = $stmt->fetch();

deleteComment($id);
    
   

header('Location: ../pages/viewPost.php?id='.$result['postID']);
?>