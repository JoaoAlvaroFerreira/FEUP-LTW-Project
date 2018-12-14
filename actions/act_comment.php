<?php
  include_once('../database/db_posts.php');
  include_once ('../database/session.php');

echo "aqui";
if(isset($_POST['fatherID']))
$fatherID = htmlspecialchars($_POST['fatherID']);
else $fatherID = 0;

$postID = htmlspecialchars($_POST['postID']);
$content = $_POST['content'];
echo "ai";
$username = $_SESSION['username'];

insertComment($content,$postID,$username, $fatherID);




//header('Location: ../pages/viewPost.php?id='.$row['postID'].'');
header('Location: ../pages/frontpage.php');
?>