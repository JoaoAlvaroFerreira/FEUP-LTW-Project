<?php
  include_once('../database/db_posts.php');
  include_once ('../database/session.php');


$title = htmlspecialchars($_POST['title']);
$type = htmlspecialchars($_POST['type']);
$content = htmlspecialchars($_POST['content']);
$channel = htmlspecialchars($_POST['channel']);
$username = $_SESSION['username'];
insertPost($title,$type,$content, $username,$channel);




header('Location: ../pages/frontpage.php');
?>