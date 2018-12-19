<?php
  include_once('../database/db_posts.php');
  include_once ('../database/session.php');


$id = htmlspecialchars($_POST['post_id']);

deletePost($id);




header('Location: ../pages/frontpage.php');
?>