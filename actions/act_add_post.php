<?php
  include_once('../database/db_posts.php');
  include_once ('../database/session.php');


$title = htmlspecialchars($_POST['title']);
$type = htmlspecialchars($_POST['type']);
$content = htmlspecialchars($_POST['content']);
$username = $_SESSION['username'];
insertPost($title,$type,$content, $username);




header('Location: ../pages/frontpage.php');
?>