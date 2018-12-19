<?php
  include_once('../database/db_posts.php');
  include_once ('../database/session.php');


$id = htmlspecialchars($_POST['id']);

$postID = htmlspecialchars($_POST['post_id']);

    

deleteComment($id);
    
   

header('Location: ../pages/viewPost.php?id='.$postID);
?>